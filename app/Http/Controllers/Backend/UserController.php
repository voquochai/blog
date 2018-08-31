<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Datetime;

class UserController extends Controller
{

    public $_data;
    public function __construct(Request $request){
        $this->_data['type'] = $request->type ? $request->type : 'default';
        $this->_data['config'] = config('siteconfigs.user.'.$this->_data['type']);
        $this->_data['page_title'] = $this->_data['config']['page-title'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_data['items'] = User::where('type',$this->_data['type'])->orderBy('priority', 'asc')->paginate(25);
        return view('backend.users.index',$this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->_data['priority'] = User::where('type',$this->_data['type'])->max('priority');
        return view('backend.users.create',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:255',
            'email'    => 'required|unique:users,email',
            'password' => 'required|min:6',
        ],[
            'name.required'     =>  'Vui lòng nhập Họ và tên',
            'email.required'    =>  'Vui lòng nhập Email',
            'email.unique'      =>  'Email này đã được đăng ký',
            'password.required' => 'Vui lòng nhập Mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất :min ký tự',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors(['errors'=>$errors->all()])->withInput();
        }else{
            $user = new User([
                'name'       =>  $request->input('name'),
                'email'      =>  $request->input('email'),
                'password'   =>  bcrypt($request->input('password')),
                'priority'   =>  User::where('type',$this->_data['type'])->max('priority')+1,
                'status'     =>  $request->input('status') ? implode(',',$request->input('status')) : '',
                'type'       =>  $this->_data['type'],
                'created_at' =>  new Datetime(),
                'updated_at' =>  new Datetime(),
            ]);
            $user->save();
        }
        return redirect()->route('admin.users.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$user->name.'</b> thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->_data['item'] = $user;
        return view('backend.users.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:255',
            'email' => 'required|unique:users,email,'.$user->id,
        ],[
            'name.required'  =>  'Vui lòng nhập Họ và tên',
            'email.required' =>  'Vui lòng nhập Email',
            'email.unique'   =>  'Email này đã được đăng ký',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors(['errors'=>$errors->all()])->withInput();
        }else{
            $user->name       =   $request->input('name');
            $user->email      =  $request->input('email');
            $user->password   =  bcrypt($request->input('password'));
            $user->status     =  $request->input('status') ? implode(',',$request->input('status')) : '';
            $user->updated_at =  new Datetime();
            $user->save();
        }
        return redirect()->route('admin.users.index', ['type'=>$this->_data['type']])->with('success','Cập nhật dữ liệu <b>'.$user->name.'</b> thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if($request->ajax()){
            if($user->delete()){
                User::where('type',$user->type)->where('priority', '>', $user->priority)->decrement('priority');
                return response()->json([
                    'head'  =>  'Thành công!',
                    'message'   =>  'Xóa dữ liệu <b>'.$user->name.'</b> thành công.',
                    'class'   =>  'success',
                ]);
            }else{
                return response()->json([
                    'head'  =>  'Cảnh báo!',
                    'message'   =>  'Xóa dữ liệu <b>'.$user->name.'</b> thất bại.',
                    'class'   =>  'warning',
                ]);
            }
            
        }else{
            if($user->delete()){
                User::where('type',$user->type)->where('priority', '>', $user->priority)->decrement('priority');
                return redirect()->route('admin.users.index', ['type'=>$this->_data['type']])->with('success','Xóa dữ liệu <b>'.$user->name.'</b> thành công');
            }else{
                return redirect()->route('admin.users.index', ['type'=>$this->_data['type']])->with('error','Xóa dữ liệu <b>'.$user->name.'</b> thất bại');
            }
        }
    }

    public function status(Request $request){
        if($request->ajax()){
            $arrID = explode(',',$request->id);
            $users = User::select('id','status')->whereIn('id',$arrID)->get();
            if( $users ){
                foreach( $users as $user ){
                    $status = explode(',',$user->status);
                    $key = array_search($request->status, $status);
                    if( $key !== false ){
                        unset($status[$key]);
                    }else{
                        $status[] = $request->status;
                    }
                    $user->status = $status ? implode(',',$status) : '';
                    $user->save();
                }
                return response()->json([
                    'head'  =>  'Thành công!',
                    'message'   =>  'Cập nhật thành công.',
                    'class'   =>  'success',
                ]);
            }else{
                return response()->json([
                    'head'  =>  'Cảnh báo!',
                    'message'   =>  'Cập nhật thất bại.',
                    'class'   =>  'warning',
                ]);
            }
        }else{
            return response()->json([
                'head'  =>  'Nguy hiểm!',
                'message'   =>  'Unauthorized.',
                'class'   =>  'error',
            ]);
        }
    }

    public function priority(Request $request){
        $id = $request->id;
        $user = User::findOrFail($id);
        $up = $request->priority;
        $curr = $user->priority;
        $max = User::where('type',$user->type)->max('priority');
        if($up > $max){
            $up = $max;
        }
        if( $up > $curr ){
            User::where('type',$user->type)->whereBetween('priority', [$curr+1, $up])->decrement('priority');
        }else{
            User::where('type',$user->type)->whereBetween('priority', [$up, $curr-1])->increment('priority');
        }

        $user->update(['priority'=>$up]);
        return response()->json([
            'head'  =>  'Thành công!',
            'message'   =>  'Cập nhật thành công.',
            'class'   =>  'success',
        ]);
    }
}
