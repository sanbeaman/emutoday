<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Announcement;
use League\Fractal;
use Carbon\Carbon;

class FractalAnnouncementTransformerModel extends Fractal\TransformerAbstract
{
	public function transform(Announcement $announcement)
	{
	    return [
	        'id'      => (int) $announcement->id,
	        'title'    =>  $announcement->title,
					'announcement' => $announcement->announcement,
					'submission_date' => $announcement->submission_date ? $announcement->submission_date->toDateString(): $announcement->created_at->toDateString(),
					'approved' => $announcement->is_approved,
					'approved_date' => $announcement->approved_date ? $announcement->approved_date->toDateString() : 'Needs Approval',
					'priority' =>  $announcement->priority,
          'start_date'   => $announcement->start_date->toDateString(),
					'end_date'   => $announcement->end_date ? $announcement->end_date->toDateString() : 'No End Date',
					'author_id'  => $announcement->author_id,
					'author_name'  => $announcement->author->full_name,
					'author_phone'  => $announcement->author->phone,
					'author_email'  => $announcement->author->email

	    ];
	}
}