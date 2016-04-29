<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

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
  protected $fillable = ['author_id', 'title', 'short_title', 'location', 'start_date', 'end_date', 'all_day', 'no_end_time', 'description'];

/**
 * [$dates description]
 * @var [type]
 */
  protected $dates = ['start_date', 'end_date'];


}
