<?php

namespace emutoday\Templates;

use Carbon\Carbon;
use emutoday\Story;

use Illuminate\View\View;

class BlogPostTemplate extends AbstractTemplate
{
    protected $view = 'public.story.main';

    protected $storys;

    public function __construct(Story $storys)
    {
        $this->storys = $storys;

    }

    public function prepare(View $view, array $parameters)
    {
        $story = $this->story->where('id', $parameters['id'])->where('story_type',$parameters['story_type']->where('slug',$parameters['slug'])->first();

        $view->with('story', $story);


    }
}
