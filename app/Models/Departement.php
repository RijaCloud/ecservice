<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = "departement";
    
    
    public function commune() {
        
        return  $this->hasMany(Commune::class);
        
    }

    public function region() {
        
        return $this->belongsTo(Region::class);
        
    }
}

