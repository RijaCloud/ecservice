<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessoires extends Model
{
    
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lieu() {

        return $this->belongsToMany(Lieu::class , 'lieu_accessoires' , 'accessoires_id');

    }
}
