<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Intervention\Image\Facades\Image;
use App\Models\Image as StrImage;

class StoreAndSaveImage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $image;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UploadedFile $file)
    {
        $this->image = $file;
    }

    /**
     * Execute the job.
     *
     * @param StrImage $image
     */
    public function handle(StrImage $image)
    {
        dd($image,$this->image);
        
    }
}
