<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $table = "region";

    /**
     * The One to many Relation
     * Dans une region on trouve plusieur commune
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commune() {

        return $this->hasMany(Commune::class);

    }

    /**
     * The One to Many Relation
     * Dans une province on peut trouver plusieur region
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function province() {

        return $this->belongsTo(Province::class);

    }

}
