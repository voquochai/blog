<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $guarded = [];

    public function products(){
    	return $this->hasMany('App\Product', 'supplier_id', 'id')->orderBy('id','asc');
    }
}
