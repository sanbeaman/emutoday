<?php

namespace emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;
class StoryPresenter extends Presenter
{

    // public function imageMainPath(){
    //
    //     $storyImage = $this->storyImages()->where('image_type', 'imagemain')->first();
    //
    //     return $storyImage->image_path . $storyImage->filename;
    // }

    public function publishedDate()
    {
        if ($this->start_date) {
            if ($this->start_date == '0000-00-00 00:00:00'){
              $carbondate = Carbon::create(2016,5,5,5,5,5);
            } else {
                $carbondate = Carbon::parse($this->start_date);
            }
            return $carbondate->toFormattedDateString();
        }

        return 'Not Published';
    }
    // public function publishedHighlight()
    // {
    //     if ($this->published_at && $this->published_at->isFuture()) {
    //         return 'info';
    //     } elseif (! $this->published_at) {
    //         return 'warning';
    //     }
    // }


}
