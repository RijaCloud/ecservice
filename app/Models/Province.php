<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Province extends Model
{
    protected $guarder = [];

    protected $table = "province";

    public $timestamps = true;

    /**
     * A province have many country
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function region() {
        
        return $this->hasMany(Region::class);
        
    }
    
    public function scopeFilter($query,$match) {

        return $query->where('nom','LIKE',"%$match%")->orderBy(DB::raw('RAND()'))->get();

    }
}
