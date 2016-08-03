<?php

namespace emutoday\Providers;

use emutoday\StoryImage;
use emutoday\Mediafile;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
         'Illuminate\Auth\Events\Login' => [
            'emutoday\Listeners\UpdateLastLoginAtOnLogin@handle',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        StoryImage::saving(function ($storyImage)
        {

            if (isset($storyImage->filename))
            {
                if(is_null($storyImage->filename))
                {
                    $storyImage->is_active = 0;
                } else {
                    if(empty($storyImage->image_name) || empty($storyImage->image_extension))
                    {
                        $storyImage->is_active = 0;
                    } else {
                        $storyImage->is_active = 1;
                    }
                }
            } else {
                $storyImage->is_active = 0;
            }

            // $storyImage->filename = $storyImage->image_name . '.' . $storyImage->image_extension;

       });

       Mediafile::saving(function ($mediafile)
       {

           if (isset($mediafile->filename))
           {
               if(is_null($mediafile->filename))
               {
                   $mediafile->is_active = 0;
               } else {
                   if(empty($mediafile->name) || empty($mediafile->ext))
                   {
                       $mediafile->is_active = 0;
                   } else {
                       $mediafile->is_active = 1;
                   }
               }
           } else {
               $mediafile->is_active = 0;
           }

           // $storyImage->filename = $storyImage->image_name . '.' . $storyImage->image_extension;

      });

        //
    }
}
