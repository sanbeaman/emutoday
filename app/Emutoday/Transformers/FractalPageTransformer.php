<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Page;
use League\Fractal;
use Carbon\Carbon;

class FractalPageTransformer extends Fractal\TransformerAbstract
{
	public function transform(Page $page)
	{
	    return [
	        'id'      => (int) $page->id,
	        'template'   => $page->template,
					'uri'   => $page->uri,
	        'active'    =>  $page->is_active,
          'start_date'   => $page->start_date->toDateString(),
					'end_date'   => $page->end_date ? $page->end_date->toDateString() : 'No End Date'
	    ];
	}
}
