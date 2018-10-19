<?php

namespace App\Http\Controllers\Backend;

use App\Attribute;
use App\AttributeLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Datetime;

class AttributeController extends Controller
{

    public $_data;

    public function __construct(Request $request){
        $this->_data['type'] = $request->type ? $request->type : 'default';
        $this->_data['language'] = config('siteconfigs.general.language');
        $this->_data['config'] = config('siteconfigs.attribute.'.$this->_data['type']);
        $this->_data['page_title'] = $this->_data['config']['page-title'];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_data['items'] = Attribute::where('type',$this->_data['type'])->orderBy('priority', 'asc')->paginate(25);
        return view('backend.attributes.index',$this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->_data['priority'] = Attribute::where('type',$this->_data['type'])->max('priority');
        return view('backend.attributes.create',$this->_data);
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
        ],[
            'dataL.vi.name.required'     =>  'Vui lòng nhập Tiêu đề'
        ]);

        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json(['type'=>'danger', 'icon'=>'warning', 'message'=>$validator->errors()->first()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $attribute  = new Attribute;
            if($request->data){
                foreach($request->data as $field => $value){
                    $attribute->$field = $value;
                }
            }
            $attribute->regular_price  = floatval(str_replace('.', '', $request->input('regular_price')));
            $attribute->sale_price     = floatval(str_replace('.', '', $request->input('sale_price')));

            $attribute->priority   = Attribute::where('type',$this->_data['type'])->max('priority')+1;
            $attribute->status     = $request->input('status') ? implode(',',$request->input('status')) : '';
            $attribute->type       = $this->_data['type'];
            $attribute->created_at = new DateTime();
            $attribute->updated_at = new DateTime();
            $attribute->save();

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
                $dataInsert[]       = new AttributeLanguage($dataL);
            }
            $attribute->languages()->saveMany($dataInsert);
            if($request->ajax()){
                $items = Attribute::select('id')->where('type',$this->_data['type'])->orderBy('priority','asc')->with(['languages' => function($query){
                    $query->select('attribute_id','name')->where('language', $this->_data['language'] );
                }])->get();
                $arrIDs = explode(',',$request->ids);
                $newData = '';
                if($items){
                    foreach($items as $item){
                        $newData .= '<option value="'.$item->id.'" '.( ( $item->id == $attribute->id || in_array($item->id,$arrIDs) ) ? 'selected' : '' ).'> '.$item->languages[0]['name'].' </option>';
                    }
                }
                return response()->json(['type'=>'success', 'icon'=>'check', 'message'=>'Thêm dữ liệu <b>'.$attribute->languages[0]->name.'</b> thành công', 'newData'=>$newData]);
            }
        }
        return redirect()->route('admin.attributes.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$attribute->name.'</b> thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $this->_data['item'] = $attribute;
        return view('backend.attributes.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $validator = Validator::make($request->all(), [
            'dataL.vi.name'     => 'required|max:255',
        ],[
            'dataL.vi.name.required'     =>  'Vui lòng nhập Tiêu đề',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if($request->data){
                foreach($request->data as $field => $value){
                    $attribute->$field = $value;
                }
            }
            
            $attribute->regular_price  = floatval(str_replace('.', '', $request->input('regular_price')));
            $attribute->sale_price     = floatval(str_replace('.', '', $request->input('sale_price')));

            $attribute->status     = $request->input('status') ? implode(',',$request->input('status')) : '';
            $attribute->type       = $this->_data['type'];
            $attribute->updated_at = new DateTime();
            $attribute->save();

            $dataL = [];
            $dataInsert = [];
            $i = 0;
            foreach(config('siteconfigs.languages') as $lang => $val){
                $attributeL = AttributeLanguage::find($attribute->languages[$i]['id']);
                if($request->dataL[$lang]){
                    foreach($request->dataL[$lang] as $fieldL => $valueL){
                        $attributeL->$fieldL = $valueL;
                    }
                }
                if( !isset($request->dataL[$this->_data['language']]['slug']) || $request->dataL[$this->_data['language']]['slug'] == ''){
                    $attributeL->slug  = str_slug($request->dataL[$this->_data['language']]['name']);
                }else{
                    $attributeL->slug  = str_slug($request->dataL[$this->_data['language']]['slug']);
                }
                $attributeL->language   = $lang;
                $attributeL->save();
                $i++;
            }
            return redirect()->route('admin.attributes.index', ['type'=>$this->_data['type']])->with('success','Cập nhật dữ liệu <b>'.$attribute->languages[0]->name.'</b> thành công');
        }
        return redirect()->route('admin.attributes.index', ['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Attribute $attribute)
    {
        if($request->ajax()){
            if($attribute->delete()){
                Attribute::where('type',$attribute->type)->where('priority', '>', $attribute->priority)->decrement('priority');
                return response()->json([
                    'head'  =>  'Thành công!',
                    'message'   =>  'Xóa dữ liệu <b>'.$attribute->name.'</b> thành công.',
                    'class'   =>  'success',
                ]);
            }else{
                return response()->json([
                    'head'  =>  'Cảnh báo!',
                    'message'   =>  'Xóa dữ liệu <b>'.$attribute->name.'</b> thất bại.',
                    'class'   =>  'warning',
                ]);
            }
        }else{
            if($attribute->delete()){
                Attribute::where('type',$this->_data['type'])->where('priority', '>', $attribute->priority)->decrement('priority');
                return redirect()->route('admin.attributes.index', ['type'=>$this->_data['type']])->with('success','Xóa dữ liệu <b>'.$attribute->name.'</b> thành công');
            }else{
                return redirect()->route('admin.attributes.index', ['type'=>$this->_data['type']])->with('error','Xóa dữ liệu <b>'.$attribute->name.'</b> thất bại');
            }
        }
    }

    public function status(Request $request){
        if($request->ajax()){
            $arrID = explode(',',$request->id);
            $attributes = Attribute::select('id','status')->whereIn('id',$arrID)->get();
            if( $attributes ){
                foreach( $attributes as $attribute ){
                    $status = explode(',',$attribute->status);
                    $key = array_search($request->status, $status);
                    if( $key !== false ){
                        unset($status[$key]);
                    }else{
                        $status[] = $request->status;
                    }
                    $attribute->status = $status ? implode(',',$status) : '';
                    $attribute->save();
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
            $attribute = Attribute::findOrFail($id);
            
            $up = $request->priority;
            $curr = $attribute->priority;
            $max = Attribute::where('type',$attribute->type)->max('priority');
            if($up > $max){
                $up = $max;
            }
            if( $up > $curr ){
                Attribute::where('type',$attribute->type)->whereBetween('priority', [$curr+1, $up])->decrement('priority');
            }else{
                Attribute::where('type',$attribute->type)->whereBetween('priority', [$up, $curr-1, ])->increment('priority');
            }

            $attribute->update(['priority'=>$up]);
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
