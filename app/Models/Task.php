<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name','description'];
    
    protected $table = "task";
    
    public function users() {
        
        $this->belongsTo(User::class);
        
    }
    
}
