<?php

namespace App\Events;

use App\Models\Lieu;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LieuHasBeenDeleted
{
    use InteractsWithSockets, SerializesModels;

    public $lieu;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Lieu $lieu)
    {
        $this->lieu = $lieu;
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
