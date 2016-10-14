<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class District extends Model
{
    protected $table = "district";
    
    
    public function commune() {
        
        return  $this->hasMany(Commune::class);
        
    }

    public function region() {
        
        return $this->belongsTo(Region::class);
        
    }

    public function scopeFilter($query,$match) {

        return $query->where('nom','LIKE',"$match%")->orderBy(DB::raw('RAND()'))->get();

    }

}

