<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "image";

    protected $fillable = ['image_dir','image_name','image_medium','image_large','image_small'];
    
    public $timestamps = true;
    
}
