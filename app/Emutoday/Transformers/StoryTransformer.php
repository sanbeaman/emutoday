<?php

namespace emutoday\Emutoday\Transformers;

 class StoryTransformer extends Transformer
{
    public function transform($story)
    {
        return [
            'story_id' => $story['id'],
            'title' => $story['title'],
            'subtitle' => $story['subtitle']
        ];
    }
}
