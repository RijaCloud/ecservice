<?php

namespace App\Listeners;

use App\Events\LieuHasBeenDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LieuDeleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LieuHasBeenDeleted  $event
     * @return void
     */
    public function handle(LieuHasBeenDeleted $event)
    {

        if(file_exists(public_path('infoImage/'.$event->lieu->string_lieu . 'large.png'))) {

            Storage::delete(public_path('infoImage/' . $event->lieu->string_lieu . 'large.png'));
            Storage::delete(public_path('infoImage/' . $event->lieu->string_lieu . 'medium.png'));
            Storage::delete(public_path('infoImage/' . $event->lieu->string_lieu . 'small.png'));

        }

    }
}
