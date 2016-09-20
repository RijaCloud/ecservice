<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{

    protected $table = "commune";

    public $timestamps = false;
    
    /**
     * The One to Many Relation
     * Dans une commune on peut trouver plusieur lieu consacrer au moto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fokontany() {
        
        return $this->hasMany(Fokontany::class);
        
    }

    /**
     * The Many To Many Relation
     * Dasn une region on peut trouver plusieur commune
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departement() {
        
        return $this->belongsTo(Departement::class);
        
    }
    
}
