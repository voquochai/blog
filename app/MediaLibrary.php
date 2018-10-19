<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    protected $casts = ['editor'=>'json'];
}
