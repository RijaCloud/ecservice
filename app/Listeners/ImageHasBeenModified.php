<?php

namespace App\Listeners;

use App\Events\ImageToModify;
use App\Models\Image;
use App\Models\Lieu;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as In;

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

        if(file_exists(public_path('infoImage/'.$lieu[0]->string_lieu . 'large.png'))) {

            Storage::delete(public_path('infoImage/' . $lieu[0]->string_lieu . 'large.png'));
            Storage::delete(public_path('infoImage/' . $lieu[0]->string_lieu . 'mediem.png'));
            Storage::delete(public_path('infoImage/' . $lieu[0]->string_lieu . 'small.png'));

            $image1 =  In::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $lieu[0]->string_lieu . 'large.png');
            $image1->resize(600,600);
            $image1->save($path1);

            $image2 = In::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $lieu[0]->string_lieu . 'medium.png');
            $image2->resize(320,320);
            $image2->save($path1);

            $image3 = In::make($event->file->getRealPath());
            $path1 = public_path('infoImage/' . $lieu[0]->string_lieu . 'small.png');
            $image3->resize(100,100);
            $image3->save($path1);

            $save = Image::where('place_id',$lieu[0]->id)->get();
            
            $save[0]->image_dir = public_path('infoImage');
            $save[0]->place_id = $lieu[0]->id;
            $save[0]->image_name = $lieu[0]->string_lieu;
            $save[0]->image_large = $lieu[0]->string_lieu . 'large.png';
            $save[0]->image_medium = $lieu[0]->string_lieu . 'medium.png';
            $save[0]->image_small = $lieu[0]->string_lieu . 'small.png';
            $save[0]->update();

            $lieu[0]->update(['image',$lieu[0]->string_lieu]);
        }
    }
}
