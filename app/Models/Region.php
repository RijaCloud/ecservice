<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Region extends Model
{

    protected $table = "region";

    /**
     * The One to many Relation
     * Dans une region on trouve plusieur district
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district() {

        return $this->hasMany(District::class);

    }

    /**
     * The One to Many Relation
     * Dans une province on peut trouver plusieur region
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function province() {

        return $this->belongsTo(Province::class);

    }
    
    public function scopeFilter($query,$match) {

        return $query->where('nom','LIKE',"%$match%")->orderBy(DB::raw('RAND()'))->get();

    }

}
