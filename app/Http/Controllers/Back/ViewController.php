<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\View\View;

class ViewController extends Controller
{
    /**
     * Will contain the current user
     * @var user
     * */
    protected $user;


    public function __construct(UserRepository $user) {
        
        $this->user = $user;
        
    }
    
    public function index(Request $request) {
        
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.index');
        } else {
            return view('admin.index');
        }
        
    }
    
    public function profile($name,Request $request) {

        if(is_null($name)) {
            return redirect(route('admin.index'));
        }
        
        $profile = $this->user->whereSlug($name);
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.profile', compact('profile'));
        } else {
            return view('admin.profile', compact('profile'));
        }
        
    }
}
