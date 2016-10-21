<?php

namespace App\Providers;

use App\Events\ImageToModify;
use App\Events\ImageToUpload;
use App\Events\LieuHasBeenDeleted;
use App\Events\UserHasLoggedIn;
use App\Listeners\ImageHasBeenModified;
use App\Listeners\ImageHaveBeenUpload;
use App\Listeners\LieuDeleted;
use App\Listeners\LogginSuccess;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserHasLoggedIn::class => [
            LogginSuccess::class,
        ],
        ImageToUpload::class => [
            ImageHaveBeenUpload::class,
        ],
        ImageToModify::class => [
            ImageHasBeenModified::class,
        ],
        LieuHasBeenDeleted::class => [
            LieuDeleted::class,
        ]
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
