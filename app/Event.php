<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use emutoday\Category;

class Event extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'cea_events';

  /**
   * [$fillable description]
   * @var [type]
   */
  protected $fillable = ['author_id', 'title', 'short_title', 'location', 'start_date', 'start_time', 'end_date', 'end_time' ,'all_day', 'no_end_time', 'description'];

/**
 * [$dates description]
 * @var [type]
 */
  protected $dates = ['start_date', 'end_date'];


  public function categories()
  {
    return $this->belongsToMany('emutoday\Category', 'category_event', 'event_id', 'category_id');
  }

  /**
   * get a list of the categories associated with this Event
   * @return [Array]
   */
  public function getCategoryListAttribute()
  {
    return $this->categories->lists('id')->all();
  }
}
