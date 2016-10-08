<?php

namespace App\Listeners;

use App\Events\UserHasLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogginSuccess
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  UserHasLoggedIn  $event
     * @return void
     */
    public function handle(UserHasLoggedIn $event)
    {
       
        $this->request->session()->put('role',$event->role);
        $this->request->session()->put('username',$event->username);
        $this->request->session()->put('id',$event->id);
        $this->request->session()->put('email',$event->email);

    }
}
