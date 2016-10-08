<?php

namespace App\Listeners;

use App\Events\ImageToUpload;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImageHaveBeenUpload
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
     * @param  ImageToUpload  $event
     * @return void
     */
    public function handle(ImageToUpload $event)
    {
        dd($event);
    }
}
