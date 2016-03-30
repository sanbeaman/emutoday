<?php

namespace emutoday\Presenters;

use Lewis\Presenter\AbstractPresenter;

class StoryImagePresenter extends AbstractPresenter
{
    protected $story;

    protected $thumbnailPath = 'thumbnails/thumb-';

    public function fullImagePath()
    {
        return $this->image_path . $this->filename;
    }
    public function thumbnailImagePath()
    {
        return $this->image_path . $this->thumbnailPath . $this->filename;
    }

    public function attachedToStoryId(){
        $story = $this->story;
        return  $this->$story->id;
    }
}
