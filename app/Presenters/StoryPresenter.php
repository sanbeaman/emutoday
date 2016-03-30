<?php

namespace emutoday\Presenters;

use Lewis\Presenter\AbstractPresenter;

class StoryPresenter extends AbstractPresenter
{
    public function __construct($object)
    {
        parent::__construct($object);
    }

    public function imageMainPath(){

        $storyImage = $this->storyImages()->where('image_type', 'imagemain')->first();

        return $storyImage->image_path . $storyImage->filename;
    }

    public function publishedDate()
    {
        if ($this->published_at) {
            return $this->published_at->toFormattedDateString();
        }

        return 'Not Published';
    }
    public function publishedHighlight()
    {
        if ($this->published_at && $this->published_at->isFuture()) {
            return 'info';
        } elseif (! $this->published_at) {
            return 'warning';
        }
    }


}
