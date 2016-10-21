<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fokontany extends Model
{

    protected $table = 'fokontany';

    protected $guarded = [];

    /**
     * The One to Many Relation
     * Dans une commune on peut trouver plusieur lieu consacrer au moto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lieu() {

        return $this->hasMany(Lieu::class);

    }
    
    public function scopeFilter($query,$match) {

        return $query->where('nom','LIKE',"%$match%")->orderBy(DB::raw('RAND()'))->take(5)->get();

    }
}
