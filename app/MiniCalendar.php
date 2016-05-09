<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class MiniCalendar extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'cea_mini_calendars';


  public function events()
  {
    return $this->belongsToMany('emutoday\Event', 'cea_event_minicalendar' , 'mini_calendar_id', 'event_id');

  }

}
