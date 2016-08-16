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
            'user' => $story->user,
            'author_id' => $story->author_id,
            'author_info' => $story->author_info,
            'story_type'   => $story->story_type,
            'group'  => $story->storyGroup->group,
            'title'    =>  $story->title,
            'slug'    =>  $story->slug,
            'subtitle'    =>  $story->subtitle,
            'content'  => $story->content,
            'is_approved' => $story->is_approved,
            'is_promoted' => $story->is_promoted,
            'is_featured' =>  $story->is_featured,
            'is_live' =>  $story->is_live,
            'is_archived' =>  $story->is_archived,
            'tags' => $story->tags->pluck('name'),
            'start_date'   =>  $story->start_date->toDateString(),
            // 'start_date'   => $story->start_date->format('m-d-Y'),
            'author' => ($story->author_id == 0)? null:$story->author
        ];
    }
}
