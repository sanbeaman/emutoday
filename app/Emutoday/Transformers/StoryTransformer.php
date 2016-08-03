<?php

namespace emutoday\Emutoday\Transformers;

 class StoryTransformer extends Transformer
{
    public function transform($story)
    {
        return [
            'story_id' => $story['id'],
            'story_type' => $story['story_type'],
            'title' => $story['title'],
            'featured' => $story['is_featured'],
            'live' =>  $story['is_live'],
                        'start_date' => $story['start_date'],
                        'end_date' => $story['end_date']
        ];
    }
}
