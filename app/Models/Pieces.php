<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pieces extends Model
{
    /**
     * The Many to Many Relation
     * Plusieurs lieu peuvent vendres un meme pieces
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lieu() {
        
        return  $this->belongsToMany(Lieu::class, 'lieu_pieces' , 'pieces_id');
        
    }
}
