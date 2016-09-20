<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lieu extends Model
{
    protected $table = "lieu";

    protected $fillable = ['string_lieu','latitude','longitude','description'];

    protected $hidden = ['created_at','updated_at','fokontany_id'];
    
    /**
     * The One to Many Relation
     * Plusieurs lieux consacrer aux motos appartienent à une commune
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fokontany() {

        return $this->belongsTo(Commune::class);

    }

    /**
     * The Many To Many Relation
     * On peut trouver plusieur huile dans un lieux precis
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function huile() {
        
        return $this->belongsToMany(Huile::class,'lieu_huile','lieu_id');
        
    }

    /**
     * The Many to Many Relation
     * Un lieu peut vendre plusieur pieces
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pieces() {
        
        return $this->belongsToMany(Pieces::class,'lieu_pieces','lieu_id');
        
    }
    
    /**
     * The One to Many Relation
     * Un lieu peu vendre plusieurs accessoires moto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accessoires() {
        
        return $this->belongsToMany(Accessoires::class, 'lieu_accessoires','lieu_id');
        
    }

    public function scopeRandom($query ,$take) {

        return $query->orderBy(DB::raw('RAND()'))->take($take);

    }
}
