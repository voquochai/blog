<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\CategoryLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Datetime;

class CategoryController extends Controller
{

    public $_data;

    public function __construct(Request $request){
        $this->_data['type'] = $request->type ? $request->type : 'default';
        $this->_data['path'] = config('siteconfigs.category.path');
        $this->_data['language'] = config('siteconfigs.general.language');
        $this->_data['config'] = config('siteconfigs.category.'.$this->_data['type']);
        $this->_data['page_title'] = $this->_data['config']['page-title'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_data['items'] = Category::with(['languages' => function ($query) {
                $query->where('language', $this->_data['language']);
            }])->where('type',$this->_data['type'])->orderBy('priority', 'asc')->get()->toTree();
        return view('backend.categories.index',$this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->_data['priority'] = Category::where('type',$this->_data['type'])->max('priority');
        $this->_data['categories'] = Category::with(['languages' => function ($query) {
                $query->where('language', $this->_data['language']);
            }])->where('type',$this->_data['type'])->orderBy('priority', 'asc')->get()->toTree();
        return view('backend.categories.create',$this->_data);
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
            'dataL.vi.name'     => 'required|max:255',
            'image' => 'image|max:2048',
        ],[
            'dataL.vi.name.required'     =>  'Vui lòng nhập Tiêu đề',
            'image.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max' => 'Dung lượng vượt quá giới hạn cho phép là :max KB',
        ]);

        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json(['type'=>'danger', 'icon'=>'warning', 'message'=>$validator->errors()->first()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $category  = new Category;
            if($request->data){
                foreach($request->data as $field => $value){
                    $category->$field = $value;
                }
            }
            if($request->hasFile('image')){
                $category->image = save_image($this->_data['path'],$request->file('image'),$this->_data['config']['thumbs']);
            }
            $category->priority   = Category::where('type',$this->_data['type'])->max('priority')+1;
            $category->status     = $request->input('status') ? implode(',',$request->input('status')) : '';
            $category->type       = $this->_data['type'];
            $category->created_at = new DateTime();
            $category->updated_at = new DateTime();
            $category->save();

            $dataL = [];
            $dataInsert = [];
            foreach(config('siteconfigs.languages') as $lang => $val){
                if($request->dataL[$lang]){
                    foreach($request->dataL[$lang] as $fieldL => $valueL){
                        $dataL[$fieldL] = $valueL;
                    }
                }
                if( !isset($request->dataL[$this->_data['language']]['slug']) || $request->dataL[$this->_data['language']]['slug'] == ''){
                    $dataL['slug']  = str_slug($request->dataL[$this->_data['language']]['name']);
                }else{
                    $dataL['slug']  = str_slug($request->dataL[$this->_data['language']]['slug']);
                }
                $dataL['language']  = $lang;
                $dataInsert[]       = new CategoryLanguage($dataL);
            }
            $category->languages()->saveMany($dataInsert);
        }
        return redirect()->route('admin.categories.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$category->name.'</b> thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->_data['categories'] = Category::with(['languages' => function ($query) {
                $query->where('language', $this->_data['language']);
            }])->where('type',$this->_data['type'])->orderBy('priority', 'asc')->get()->toTree();
        $this->_data['item'] = $category;
        return view('backend.categories.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        if($request->ajax()){

            if( $category->descendants->count() ){
                return response()->json([
                    'head'  =>  'Cảnh báo!',
                    'message'   =>  'Vui lòng xóa cấc phụ thuộc <b>'.$category->name.'</b> trước.',
                    'class'   =>  'warning',
                ]);
            }else{
                if($category->delete()){
                    delete_image($this->_data['path'].'/'.$category->image,$this->_data['thumbs']);
                    Category::where('type',$category->type)->where('priority', '>', $category->priority)->decrement('priority');
                    return response()->json([
                        'head'  =>  'Thành công!',
                        'message'   =>  'Xóa dữ liệu <b>'.$category->name.'</b> thành công.',
                        'class'   =>  'success',
                    ]);
                }else{
                    return response()->json([
                        'head'  =>  'Cảnh báo!',
                        'message'   =>  'Xóa dữ liệu <b>'.$category->name.'</b> thất bại.',
                        'class'   =>  'warning',
                    ]);
                }
            }
        }else{
            if( $category->descendants->count() ){
                return redirect()->route('admin.categories.index', ['type'=>$this->_data['type']])->with('error','Vui lòng xóa cấc phụ thuộc <b>'.$category->name.'</b> trước');
            }else{
                if($category->delete()){
                    delete_image($this->_data['path'].'/'.$category->image,$this->_data['config']['thumbs']);
                    Category::where('type',$this->_data['type'])->where('priority', '>', $category->priority)->decrement('priority');
                    return redirect()->route('admin.categories.index', ['type'=>$this->_data['type']])->with('success','Xóa dữ liệu <b>'.$category->name.'</b> thành công');
                }else{
                    return redirect()->route('admin.categories.index', ['type'=>$this->_data['type']])->with('error','Xóa dữ liệu <b>'.$category->name.'</b> thất bại');
                }
            }
        }
    }

    public function status(Request $request){
        if($request->ajax()){
            $arrID = explode(',',$request->id);
            $categories = Category::select('id','status')->whereIn('id',$arrID)->get();
            if( $categories ){
                foreach( $categories as $category ){
                    $status = explode(',',$category->status);
                    $key = array_search($request->status, $status);
                    if( $key !== false ){
                        unset($status[$key]);
                    }else{
                        $status[] = $request->status;
                    }
                    $category->status = $status ? implode(',',$status) : '';
                    $category->save();
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
        $category = Category::findOrFail($id);
        
        $up = $request->priority;
        $curr = $category->priority;
        $max = Category::where('type',$category->type)->max('priority');
        if($up > $max){
            $up = $max;
        }
        if( $up > $curr ){
            Category::where('type',$category->type)->whereBetween('priority', [$curr+1, $up])->decrement('priority');
        }else{
            Category::where('type',$category->type)->whereBetween('priority', [$up, $curr-1, ])->increment('priority');
        }

        $category->update(['priority'=>$up]);
        return response()->json([
            'head'  =>  'Thành công!',
            'message'   =>  'Cập nhật thành công.',
            'class'   =>  'success',
        ]);
    }
}
