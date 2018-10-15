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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
