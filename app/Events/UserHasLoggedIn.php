<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasLoggedIn
{
    use InteractsWithSockets, SerializesModels;

    /**
     * The authenticated user id
     * @var integer
     * */
    public $id ;
    /**
     * The authenticated user name
     * @var username
     * */
    public $username;
    /**
     * The authenticated user role
     * @var string
     * */
    public $role;
    /**
     * The authenticated user email
     * @var string
     * */
    public $email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->id = $user->id;
        $this->username = $user->name;
        $this->role = $user->role;
        $this->email = $user->email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
