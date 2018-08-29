<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public $_data;
    public function __construct(Request $request){
        $this->_data['page_title'] = 'Bảng điều khiển';
    }
    public function index(){
    	return view('backend.layouts.dashboard', $this->_data);
    }
}
