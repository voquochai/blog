<?php

namespace App\Http\Controllers\Backend;

use App\Product;
use App\ProductLanguage;
use App\Category;
use App\CategoryLanguage;
use App\Supplier;
use App\MediaLibrary;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use Datetime;

class ProductController extends Controller
{

    public $_data;

    public function __construct(Request $request){
        $this->_data['type'] = $request->type ? $request->type : 'default';
        $this->_data['path'] = config('siteconfigs.product.path');
        $this->_data['language'] = config('siteconfigs.general.language');
        $this->_data['config'] = config('siteconfigs.product.'.$this->_data['type']);
        $this->_data['page_title'] = $this->_data['config']['page-title'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_data['items'] = Product::where('type',$this->_data['type'])->orderBy('priority', 'asc')->paginate(25);
        return view('backend.products.index',$this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->_data['priority'] = Product::where('type',$this->_data['type'])->max('priority');
        $this->_data['categories'] = Category::where('type',$this->_data['type'])->orderBy('priority', 'asc')->get()->toTree();
        $this->_data['suppliers'] = Supplier::select('id','name')->where('type','default')->orderBy('priority', 'asc')->get();

        return view('backend.products.create',$this->_data);
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
            'dataL.vi.name'   => 'required|max:255',
            'data.code'        => 'required|max:50|unique:products,code',
            'image'            => 'image|max:2048'
        ], [
            'dataL.vi.name.required'   => 'Vui lòng nhập Tiêu đề',
            'data.code.required'   => 'Vui lòng nhập Mã Sản Phẩm',
            'data.code.unique'          => 'Mã sản phẩm đã tồn tại, vui lòng nhập mã khác',
            'image.image'               => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max'                 => 'Dung lượng vượt quá giới hạn cho phép là :max KB',
        ]);

        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json(['type'=>'danger', 'icon'=>'warning', 'message'=>$validator->errors()->first()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $product  = new Product;
            if($request->data){
                foreach($request->data as $field => $value){
                    $product->$field = $value;
                }
            }
            if($request->hasFile('image')){
                $fileuploader = json_decode($request->input('fileuploader-list-image'),true);
                $file = $request->file('image');
                $product->image = save_image($this->_data['path'],$file,$fileuploader[0],$this->_data['config']['thumbs']);
            }
            if($request->hasFile('images')){
                $fileuploader = json_decode($request->input('fileuploader-list-images'),true);
                $files = $request->file('images');
                foreach($files as $key => $file){
                    $fileName  = $file->getClientOriginalName();
                    if( false !== $key = array_search($fileName, $request->attachment['name']) ){
                        $fileMime  = $file->getClientMimeType();
                        $fileSize  = $file->getClientSize();
                        $imageName = save_image($this->_data['path'],$file,$fileuploader[$key],$this->_data['config']['thumbs']);
                        $media = MediaLibrary::create([
                            'name' => $imageName,
                            'alt'   => $request->attachment['alt'][$key],
                            'editor' => isset($fileuploader[$key]['editor']) ? $fileuploader[$key]['editor'] : '',
                            'mime_type' => $fileMime,
                            'type' => $this->_data['type'],
                            'size' => $fileSize,
                            'priority'   => $request->attachment['priority'][$key],
                        ]);
                        $media_list_id[] = $media->id;
                        unset($fileuploader[$key]);
                    }
                }
                $product->attachments = implode(',',$media_list_id);
            }

            $product->original_price  = floatval(str_replace('.', '', $request->input('original_price')));
            $product->regular_price   = floatval(str_replace('.', '', $request->input('regular_price')));
            $product->sale_price      = floatval(str_replace('.', '', $request->input('sale_price')));
            $product->weight          = floatval(str_replace('.', '', $request->input('weight')));

            $product->priority   = Product::where('type',$this->_data['type'])->max('priority')+1;
            $product->status     = $request->input('status') ? implode(',',$request->input('status')) : '';
            $product->type       = $this->_data['type'];
            $product->user_id    = Auth::id();
            $product->created_at = new DateTime();
            $product->updated_at = new DateTime();
            $product->save();

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
                $dataInsert[]       = new ProductLanguage($dataL);
            }
            $product->languages()->saveMany($dataInsert);
        }
        return redirect()->route('admin.products.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$request->dataL[$this->_data['language']]['name'].'</b> thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->_data['categories'] = Category::where('type',$this->_data['type'])->orderBy('priority', 'asc')->get()->toTree();
        $this->_data['suppliers'] = Supplier::select('id','name')->where('type','default')->orderBy('priority', 'asc')->get();
        $this->_data['images'] = $product->attachments ? MediaLibrary::whereIn('id', explode(',',$product->attachments) )->orderBy('id', 'asc')->get() : [];
        $this->_data['item'] = $product;

        return view('backend.products.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'dataL.vi.name'   => 'required|max:255',
            'data.code'       => 'required|max:50|unique:products,code,'.$product->id,
            'image'           => 'image|max:2048'
        ], [
            'dataL.vi.name.required'    => 'Vui lòng nhập Tiêu đề',
            'data.code.required'        => 'Vui lòng nhập Mã Sản Phẩm',
            'data.code.unique'          => 'Mã sản phẩm đã tồn tại, vui lòng nhập mã khác',
            'image.image'               => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max'                 => 'Dung lượng vượt quá giới hạn cho phép là :max KB',
        ]);

        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json(['type'=>'danger', 'icon'=>'warning', 'message'=>$validator->errors()->first()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if($request->data){
                foreach($request->data as $field => $value){
                    $product->$field = $value;
                }
            }
            if($request->hasFile('image')){
                delete_image($this->_data['path'].'/'.$product->image,$this->_data['config']['thumbs']);
                $fileuploader = json_decode($request->input('fileuploader-list-image'),true);
                $file = $request->file('image');
                $product->image = save_image($this->_data['path'],$file,$fileuploader[0],$this->_data['config']['thumbs']);
            }elseif( $request->input('fileuploader-list-image') ){
                $fileuploader = json_decode($request->input('fileuploader-list-image'),true);
                if( isset($fileuploader[0]['editor']) ){
                    $product->image = edit_image($this->_data['path'],$product->image,$fileuploader[0],$this->_data['config']['thumbs']);
                }
            }

            $fileuploaders = json_decode($request->input('fileuploader-list-images'),true);
            $media_list_id = [];
            if($request->media){
                foreach($request->media['id'] as $key => $media_id){
                    if( isset($fileuploaders[$key]['editor']) ){
                        $media = MediaLibrary::findOrFail($media_id);
                        $media->name = edit_image($this->_data['path'],$media->name,$fileuploaders[$key],$this->_data['config']['thumbs']);
                        $media->editor = $fileuploaders[$key]['editor'];
                        $media->priority = $request->media['priority'][$key];
                        $media->save();
                    }
                    $media_list_id[] = $media_id;
                    unset($fileuploaders[$key]);
                }
                $fileuploaders = array_values($fileuploaders);
            }

            if($request->hasFile('images')){
                $files = $request->file('images');
                foreach($files as $key => $file){
                    $fileName  = $file->getClientOriginalName();
                    if( false !== $key = array_search($fileName, $request->attachment['name']) ){
                        $fileMime  = $file->getClientMimeType();
                        $fileSize  = $file->getClientSize();
                        $imageName = save_image($this->_data['path'],$file,$fileuploaders[$key],$this->_data['config']['thumbs']);
                        $media = MediaLibrary::create([
                            'name' => $imageName,
                            'alt'   => $request->attachment['alt'][$key],
                            'editor' => isset($fileuploaders[$key]['editor']) ? $fileuploaders[$key]['editor'] : '',
                            'mime_type' => $fileMime,
                            'type' => $this->_data['type'],
                            'size' => $fileSize,
                            'priority'   => $request->attachment['priority'][$key],
                        ]);
                        $media_list_id[] = $media->id;
                        unset($fileuploaders[$key]);
                    }
                }
            }
            $product->attachments     = implode(',',$media_list_id);
            $product->original_price  = floatval(str_replace('.', '', $request->input('original_price')));
            $product->regular_price   = floatval(str_replace('.', '', $request->input('regular_price')));
            $product->sale_price      = floatval(str_replace('.', '', $request->input('sale_price')));
            $product->weight          = floatval(str_replace('.', '', $request->input('weight')));

            $product->status     = $request->input('status') ? implode(',',$request->input('status')) : '';
            $product->type       = $this->_data['type'];
            $product->updated_at = new DateTime();
            $product->save();

            $dataL = [];
            $dataInsert = [];
            $i = 0;
            foreach(config('siteconfigs.languages') as $lang => $val){
                $productL = ProductLanguage::find($product->languages[$i]['id']);
                if($request->dataL[$lang]){
                    foreach($request->dataL[$lang] as $fieldL => $valueL){
                        $productL->$fieldL = $valueL;
                    }
                }
                if( !isset($request->dataL[$this->_data['language']]['slug']) || $request->dataL[$this->_data['language']]['slug'] == ''){
                    $productL->slug  = str_slug($request->dataL[$this->_data['language']]['name']);
                }else{
                    $productL->slug  = str_slug($request->dataL[$this->_data['language']]['slug']);
                }
                $productL->language   = $lang;
                $productL->save();
                $i++;
            }
            return redirect()->route('admin.products.index', ['type'=>$this->_data['type']])->with('success','Cập nhật dữ liệu <b>'.$request->dataL[$this->_data['language']]['name'].'</b> thành công');
        }
        return redirect()->route('admin.products.index', ['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        if($request->ajax()){
            if($product->delete()){
                $thumbs = config('siteconfigs.product.'.$product->type.'.thumbs');
                delete_image($this->_data['path'].'/'.$product->image,$thumbs);
                if( $product->attachments ){
                    $arrID = explode(',',$product->attachments);
                    $medias = MediaLibrary::whereIn('id',$arrID)->get();
                    if( $medias !== null ){
                        foreach( $medias as $media ){
                            delete_image($this->_data['path'].'/'.$media->name,$thumbs);
                        }
                        MediaLibrary::destroy($arrID);
                    }
                }
                Product::where('type',$product->type)->where('priority', '>', $product->priority)->decrement('priority');
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
            if($product->delete()){
                delete_image($this->_data['path'].'/'.$product->image,$this->_data['config']['thumbs']);
                if( $product->attachments ){
                    $arrID = explode(',',$product->attachments);
                    $medias = MediaLibrary::whereIn('id',$arrID)->get();
                    if( $medias !== null ){
                        foreach( $medias as $media ){
                            delete_image($this->_data['path'].'/'.$media->name,$this->_data['config']['thumbs']);
                        }
                        MediaLibrary::destroy($arrID);
                    }
                }
                Product::where('type',$this->_data['type'])->where('priority', '>', $product->priority)->decrement('priority');
                return redirect()->route('admin.products.index', ['type'=>$this->_data['type']])->with('success','Xóa dữ liệu thành công');
            }else{
                return redirect()->route('admin.products.index', ['type'=>$this->_data['type']])->with('error','Xóa dữ liệu thất bại');
            }
        }
    }

    public function status(Request $request){
        if($request->ajax()){
            $arrID = explode(',',$request->id);
            $products = Product::select('id','status')->whereIn('id',$arrID)->get();
            if( $products ){
                foreach( $products as $product ){
                    $status = explode(',',$product->status);
                    $key = array_search($request->status, $status);
                    if( $key !== false ){
                        unset($status[$key]);
                    }else{
                        $status[] = $request->status;
                    }
                    $product->status = $status ? implode(',',$status) : '';
                    $product->save();
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
            $product = Product::findOrFail($id);
            
            $up = $request->priority;
            $curr = $product->priority;
            $max = Product::where('type',$product->type)->max('priority');
            if($up > $max){
                $up = $max;
            }
            if( $up > $curr ){
                Product::where('type',$product->type)->whereBetween('priority', [$curr+1, $up])->decrement('priority');
            }else{
                Product::where('type',$product->type)->whereBetween('priority', [$up, $curr-1, ])->increment('priority');
            }

            $product->update(['priority'=>$up]);
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

    public function remove(Request $request, $id){
        if($request->ajax()){
            $product = Product::findOrFail($id);
            $thumbs = config('siteconfigs.product.'.$product->type.'.thumbs');
            delete_image($this->_data['path'].'/'.$product->image,$thumbs);
            $product->update(['image'=>'']);
            return response()->json([
                'head'  =>  'Thành công!',
                'message'   =>  'Xóa hình ảnh thành công.',
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

    public function removeMedia(Request $request, $id){
        if($request->ajax()){
            $product = Product::findOrFail($id);
            $thumbs = config('siteconfigs.product.'.$product->type.'.thumbs');
            $media = MediaLibrary::findOrFail($request->input('id'));
            if( $media->delete() ){
                delete_image($this->_data['path'].'/'.$media->name,$thumbs);
                $product->attachments = implode(',', MediaLibrary::whereIn('id', explode(',',$product->attachments))->pluck('id')->toArray());
            }
            $product->save();
            return response()->json([
                'head'  =>  'Thành công!',
                'message'   =>  'Xóa hình ảnh thành công.',
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
