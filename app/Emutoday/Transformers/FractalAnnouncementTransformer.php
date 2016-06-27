<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Announcement;
use League\Fractal;
use Carbon\Carbon;

class FractalAnnouncementTransformer extends Fractal\TransformerAbstract
{
	public function transform(Announcement $announcement)
	{
	    return [
	        'id'      => (int) $announcement->id,
	        'title'    =>  $announcement->title,
					'approved' => $announcement->is_approved,
					'promoted' => (boolean) $announcement->is_promoted,
          'start_date'   => $announcement->start_date->toDateString(),
					'end_date'   => $announcement->end_date ? $announcement->end_date->toDateString() : 'No End Date'
	    ];
	}
}
