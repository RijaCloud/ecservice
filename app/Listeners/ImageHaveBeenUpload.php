<?php

namespace App\Listeners;

use App\Events\ImageToUpload;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Intervention\Image\Facades\Image;

class ImageHaveBeenUpload
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Handle the event.
     *
     * @param  ImageToUpload  $event
     * @return void
     */
    public function handle(ImageToUpload $event)
    {

        if(!is_dir(public_path('infoImage')))
            mkdir(public_path('infoImage'),777);

        if(!file_exists('infoImage/'.$event->lieu->string_lieu . 'large.png')) {
            
            $image1 =  Image::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $event->lieu->string_lieu . 'large.png');
            $image1->resize(600,600);
            $image1->save($path1);

            $image2 = Image::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $event->lieu->string_lieu . 'medium.png');
            $image2->resize(320,320);
            $image2->save($path1);

            $image3 = Image::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $event->lieu->string_lieu . 'small.png');
            $image3->resize(100,100);
            $image3->save($path1);

            $save = new \App\Models\Image();
            $save->image_dir = public_path('infoImage');
            $save->image_name = $event->lieu->string_lieu;
            $save->image_large = $event->lieu->string_lieu . 'large.png';
            $save->image_medium = $event->lieu->string_lieu . 'medium.png';
            $save->image_small = $event->lieu->string_lieu . 'small.png';
            $save->save();

        }



    }
}
