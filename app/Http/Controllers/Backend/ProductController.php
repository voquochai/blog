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
                    $fileMime  = $file->getClientMimeType();
                    $fileSize  = $file->getClientSize();
                    $imageName = save_image($this->_data['path'],$file,$fileuploader[$key],$this->_data['config']['thumbs']);
                    $media = new MediaLibrary([
                        'image' => $imageName,
                        'editor' => isset($fileuploader[$key]['editor']) ? $fileuploader[$key]['editor'] : '',
                        'mime_type' => $fileMime,
                        'type' => $this->_data['type'],
                        'size' => $fileSize,
                    ]);
                    $media_list_id[] = $media->id;
                }
                $product->attachments = implode(',',$media_list_id);
            }

            $product->original_price  = floatval(str_replace('.', '', $request->input('original_price')));
            $product->regular_price  = floatval(str_replace('.', '', $request->input('regular_price')));
            $product->sale_price     = floatval(str_replace('.', '', $request->input('sale_price')));
            $product->weight     = floatval(str_replace('.', '', $request->input('weight')));

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
        return redirect()->route('admin.categories.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$product->languages[0]->name.'</b> thành công');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
