<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ImageToModify
{
    use InteractsWithSockets, SerializesModels;

    public $file;

    public $id;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( UploadedFile $file , $id)
    {
        $this->file = $file;
        $this->id = $id;
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
