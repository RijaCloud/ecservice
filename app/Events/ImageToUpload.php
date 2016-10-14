<?php

namespace App\Events;

use App\Models\Lieu;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ImageToUpload
{
    use InteractsWithSockets, SerializesModels;

    public $file;
    
    public $lieu;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( UploadedFile $file , Lieu $lieu)
    {
        $this->file = $file;
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
