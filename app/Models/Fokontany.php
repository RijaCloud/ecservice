<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fokontany extends Model
{

    protected $table = 'fokontany';
    
    /**
     * The One to Many Relation
     * Dans une commune on peut trouver plusieur lieu consacrer au moto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lieu() {

        return $this->hasMany(Lieu::class);

    }

}
