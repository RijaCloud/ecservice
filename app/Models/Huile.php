<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Huile extends Model
{
    /**
     * The Many to Many Relation
     * Plusieurs lieux peuvent vendre de l'huile 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lieu() {
        
        return $this->belongsToMany(Lieu::class, 'lieu_huile' , 'huile_id');
        
    }
}
