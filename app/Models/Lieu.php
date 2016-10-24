<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lieu extends Model
{
    protected $table = "lieu";

    protected $guarded = [];

    protected $hidden = ['created_at','updated_at','fokontany_id','commune_id','district_id','province_id'];

    public $timestamps = true;

    /**
     * The One to Many Relation
     * Plusieurs lieux consacrer aux motos appartienent à une commune
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fokontany() {

        return $this->belongsTo(Fokontany::class,'fokontany_id');

    }
    
    public function image() {
        
        return $this->hasOne(Image::class);
        
    }
    
    public function scopeRandom($query ,$take) {

        return $query->orderBy(DB::raw('RAND()'))->take($take);

    }
}
