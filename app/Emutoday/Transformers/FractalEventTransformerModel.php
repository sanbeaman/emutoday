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
                    'submission_date' => $event->submission_date ? $event->submission_date: $event->created_at->toDateString(),
                    'approved' => $event->approved,
                    'approved_date' => $event->approved_date ? $event->approved_date : 'Needs Approval',
                    'priority' =>  $event->priority,
                    'start_date'   => $event->start_date->toDateString(),
                    'end_date'   => $event->end_date ? $event->end_date->toDateString() : 'No End Date',
                    'canceled' => $event->canceled
                    // 'author_id'  => $event->author_id,
                    // 'author_name'  => $event->author->full_name,
                    // 'author_phone'  => $event->author->phone,
                    // 'author_email'  => $event->author->email

        ];
    }
}
