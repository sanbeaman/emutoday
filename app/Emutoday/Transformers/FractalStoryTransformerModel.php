<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Story;
use League\Fractal;
use Carbon\Carbon;

class FractalStoryTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Story $story)
    {
        return [
            'id'      => (int) $story->id,
            'user_id' => $story->user_id,
            'author' => $story->author,
            'author_info' => $story->author_info,
            'type'   => $story->storyGroup->group,
            'title'    =>  $story->title,
            'content'  => $story->content,
            'approved' => $story->is_approved,
            'promoted' => $story->is_promoted,
            'featured' =>  $story->is_featured,
            'live' =>  $story->is_live,
            'archived' =>  $story->is_archived,
            'start_date'   => $story->start_date->format('m-d-Y')
        ];
    }
}
