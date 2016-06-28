<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Story;
use League\Fractal;
use Carbon\Carbon;

class FractalStoryTransformer extends Fractal\TransformerAbstract
{
	public function transform(Story $story)
	{
	    return [
	        'id'      => (int) $story->id,
	        'type'   => $story->story_type,
	        'title'    =>  $story->title,
					'featured' =>  $story->is_featured,
					'approved' => $story->is_approved,
					'live' =>  $story->is_live,
          'start_date'   => $story->start_date->toDateString(),
					'end_date'   => $story->end_date ? $story->end_date->toDateString() : 'No End Date'
	    ];
	}
}
