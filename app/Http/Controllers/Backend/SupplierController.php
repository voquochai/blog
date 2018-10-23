<?php

namespace App\Http\Controllers\Backend;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Datetime;

class SupplierController extends Controller
{

    public $_data;
    public function __construct(Request $request){
        $this->_data['type'] = $request->type ? $request->type : 'default';
        $this->_data['config'] = config('siteconfigs.supplier.'.$this->_data['type']);
        $this->_data['page_title'] = $this->_data['config']['page-title'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_data['items'] = Supplier::where('type',$this->_data['type'])->orderBy('priority', 'asc')->paginate(25);
        return view('backend.suppliers.index',$this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->_data['priority'] = Supplier::where('type',$this->_data['type'])->max('priority');
        return view('backend.suppliers.create',$this->_data);
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
            'name'     => 'required',
            'code'     => 'required|max:20|unique:suppliers,code',
            'email'    => 'required|email|unique:suppliers,email',
        ],[
            'name.required'     =>  'Vui lòng nhập Họ và tên',
            'code.required'     =>  'Vui lòng nhập Mã nhà cung cấp',
            'code.max'          =>  'Vui lòng chỉ nhập :max ký tự',
            'code.unique'       =>  'Mã nhà cung cấp đã tồn tại',
            'email.required'    =>  'Vui lòng nhập Email',
            'email.email'       =>  'Vui lòng nhập đúng định dạng Email',
            'email.unique'      =>  'Email này đã được đăng ký',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $supplier = new Supplier([
                'name'       =>  $request->input('name'),
                'email'      =>  $request->input('email'),
                'phone'      =>  $request->input('phone'),
                'address'    =>  $request->input('address'),
                'description'=>  $request->input('description'),
                'code'       =>  $request->input('code'),
                'priority'   =>  Supplier::where('type',$this->_data['type'])->max('priority')+1,
                'status'     =>  $request->input('status') ? implode(',',$request->input('status')) : '',
                'type'       =>  $this->_data['type'],
                'created_at' =>  new Datetime(),
                'updated_at' =>  new Datetime(),
            ]);
            $supplier->save();
        }
        return redirect()->route('admin.suppliers.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$supplier->name.'</b> thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $this->_data['item'] = $supplier;
        return view('backend.suppliers.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'code'     => 'required|max:20|unique:suppliers,code,'.$supplier->id,
            'email'    => 'required|email|unique:suppliers,email,'.$supplier->id,
        ],[
            'name.required'     =>  'Vui lòng nhập Họ và tên',
            'code.required'     =>  'Vui lòng nhập Mã nhà cung cấp',
            'code.max'          =>  'Vui lòng chỉ nhập :max ký tự',
            'code.unique'       =>  'Mã nhà cung cấp đã tồn tại',
            'email.required'    =>  'Vui lòng nhập Email',
            'email.email'       =>  'Vui lòng nhập đúng định dạng Email',
            'email.unique'      =>  'Email này đã được đăng ký',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $supplier->name         =  $request->input('name');
            $supplier->email        =  $request->input('email');
            $supplier->phone        =  $request->input('phone');
            $supplier->address      =  $request->input('address');
            $supplier->description  =  $request->input('description');
            $supplier->code         =  $request->input('code');
            $supplier->status       =  $request->input('status') ? implode(',',$request->input('status')) : '';
            $supplier->updated_at   =  new Datetime();
            $supplier->save();
        }
        return redirect()->route('admin.suppliers.index', ['type'=>$this->_data['type']])->with('success','Cập nhật dữ liệu <b>'.$supplier->name.'</b> thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Supplier $supplier)
    {
        if($request->ajax()){
            if($supplier->delete()){
                Supplier::where('type',$supplier->type)->where('priority', '>', $supplier->priority)->decrement('priority');
                return response()->json([
                    'head'  =>  'Thành công!',
                    'message'   =>  'Xóa dữ liệu thành công.',
                    'class'   =>  'success',
                ]);
            }else{
                return response()->json([
                    'head'  =>  'Cảnh báo!',
                    'message'   =>  'Xóa dữ liệu thất bại.',
                    'class'   =>  'warning',
                ]);
            }
            
        }else{
            if($supplier->delete()){
                Supplier::where('type',$supplier->type)->where('priority', '>', $supplier->priority)->decrement('priority');
                return redirect()->route('admin.suppliers.index', ['type'=>$this->_data['type']])->with('success','Xóa dữ liệu thành công');
            }else{
                return redirect()->route('admin.suppliers.index', ['type'=>$this->_data['type']])->with('error','Xóa dữ liệu thất bại');
            }
        }
    }

    public function status(Request $request){
        if($request->ajax()){
            $arrID = explode(',',$request->id);
            $suppliers = Supplier::select('id','status')->whereIn('id',$arrID)->get();
            if( $suppliers ){
                foreach( $suppliers as $supplier ){
                    $status = explode(',',$supplier->status);
                    $key = array_search($request->status, $status);
                    if( $key !== false ){
                        unset($status[$key]);
                    }else{
                        $status[] = $request->status;
                    }
                    $supplier->status = $status ? implode(',',$status) : '';
                    $supplier->save();
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
        if($request->ajax()){
            $id = $request->id;
            $supplier = Supplier::findOrFail($id);
            $up = $request->priority;
            $curr = $supplier->priority;
            $max = Supplier::where('type',$supplier->type)->max('priority');
            if($up > $max){
                $up = $max;
            }
            if( $up > $curr ){
                Supplier::where('type',$supplier->type)->whereBetween('priority', [$curr+1, $up])->decrement('priority');
            }else{
                Supplier::where('type',$supplier->type)->whereBetween('priority', [$up, $curr-1])->increment('priority');
            }

            $supplier->update(['priority'=>$up]);
            return response()->json([
                'head'  =>  'Thành công!',
                'message'   =>  'Cập nhật thành công.',
                'class'   =>  'success',
            ]);
        }else{
            return response()->json([
                'head'  =>  'Nguy hiểm!',
                'message'   =>  'Unauthorized.',
                'class'   =>  'error',
            ]);
        }
    }

}
