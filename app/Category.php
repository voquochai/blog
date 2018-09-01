<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
	use NodeTrait;
	
    protected $table = 'categories';
    protected $guarded = [];

    public function languages(){
    	return $this->hasMany('App\CategoryLanguage', 'category_id', 'id');
    }
}
