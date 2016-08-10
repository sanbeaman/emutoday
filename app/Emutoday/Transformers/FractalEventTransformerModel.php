<?php

namespace emutoday\Emutoday\Transformers;

use emutoday\Event;
use League\Fractal;
use Carbon\Carbon;

class FractalEventTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Event $event)
    {
        return [
            'id'      => (int) $event->id,
            'title'    =>  $event->title,
            'description' => $event->description,
            'submission_date' => is_null($event->submission_date) ? "no date" : $event->submission_date->toDateString(),
            'approved' => $event->is_approved,
            'approved_date' => is_null($event->approved_date) ?'Needs Approval' :  $event->approved_date->toDateString(),
            'priority' =>  $event->priority,
            'promoted' => $event->is_promoted,
            'featured' => $event->is_featured,
            'start_date'   => is_null($event->start_date)? 'No End Date':$event->start_date->toDateString(),
            'start_time' => $event->start_time,
            'end_date'   => is_null($event->end_date) ?'No End Date': $event->end_date->toDateString(),
            'canceled' => $event->is_canceled,
            'eventimage' => ($event->mediafile_id > 0)?$event->mediaFile->filename: null
                    

        ];
    }
}
