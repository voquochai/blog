<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLanguage extends Model
{
    protected $table = 'category_languages';
    protected $guarded = [];

    public function category(){
    	return $this->belongsTo('App\Category', 'category_id');
    }
}
