<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Event;
use League\Fractal;
use Carbon\Carbon;

class FractalEventTransformer extends Fractal\TransformerAbstract
{
	public function transform(Event $event)
	{
	    return [
	        'id'      => (int) $event->id,
	        'title'    =>  $event->short_title ?  $event->short_title : $event->title,
					'featured' => (boolean) $event->featured,
					'approved' => (boolean) $event->approved,
					'canceled' => (boolean) $event->canceled,
					'promoted' => (boolean) $event->homepage,
          'start_date'   => $event->start_date->toDateString(),
					'end_date'   => $event->end_date ? $event->end_date->toDateString() : 'No End Date'
	    ];
	}
}
