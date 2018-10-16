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
        $this->_data['items'] = Attribute::with(['languages' => function ($query) {
                $query->where('language', $this->_data['language']);
            }])->where('type',$this->_data['type'])->orderBy('priority', 'asc')->paginate(25);
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
            'dataL.vi.name'     => 'required|max:255'
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
                $dataInsert[]       = new CategoryLanguage($dataL);
            }
            $attribute->languages()->saveMany($dataInsert);
        }
        return redirect()->route('admin.categories.index', ['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$attribute->name.'</b> thành công');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
