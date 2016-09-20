<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    

}
