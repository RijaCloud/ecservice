<?php

namespace App\Listeners;

use App\Events\ImageToModify;
use App\Models\Image;
use App\Models\Lieu;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImageHasBeenModified
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
     * @param  ImageToModify  $event
     * @return void
     */
    public function handle(ImageToModify $event)
    {
        $lieu = Lieu::where('id',$event->id)->get();

        if(file_exists('infoImage/'.$lieu->get('string_lieu') . 'large.png')) {

            $image1 =  Image::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $lieu->get('string_lieu') . 'large.png');
            $image1->resize(600,600);
            $image1->save($path1);

            $image2 = Image::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $lieu->get('string_lieu') . 'medium.png');
            $image2->resize(320,320);
            $image2->save($path1);

            $image3 = Image::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $lieu->get('string_lieu') . 'small.png');
            $image3->resize(100,100);
            $image3->save($path1);

            $save = Image::where('place_id',$lieu->id)->get();
            $save->image_dir = public_path('infoImage');
            $save->place_id = $lieu->get('id');
            $save->image_name = $lieu->get('string_lieu');
            $save->image_large = $lieu->get('string_lieu') . 'large.png';
            $save->image_medium = $lieu->get('string_lieu') . 'medium.png';
            $save->image_small = $lieu->get('string_lieu') . 'small.png';
            $save->update();

        }
    }
}
