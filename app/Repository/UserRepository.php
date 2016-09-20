<?php

namespace App\Repository;

use App\User;

class UserRepository {

    protected $model ;

    /**
     * Used to work with the user
     * @param \App\User
     * 
     * */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Get the current user Role
     * 
     * @return string
     * */
    public function getRole() {

        return session('role');

    }
    
    public function whereSlug($name) {
        
        return $this->model->whereSlug($name)->first();
        
    }
}