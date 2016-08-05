<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use emutoday\Category;
use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;

class Event extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'cea_events';


  use PresentableTrait;
  protected $presenter = 'emutoday\Presenters\EventPresenter';

  /**
   * [$fillable description]
   * @var [type]
   */
  protected $fillable = ['author_id', 'title', 'short_title', 'location', 'start_date', 'start_time', 'end_date', 'end_time' ,'all_day', 'no_end_time', 'description', 'building','room'];

/**
 * [$dates description]
 * @var [type]
 */
  protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];

  /**
      * The attributes that should be casted to native types.
      *
      * @var array
      */
     protected $casts = [
         'all_day' => 'boolean',
        'no_end_time' => 'boolean',
        'free' =>  'boolean',
          'lbc_approved' =>  'boolean',
          'featured' => 'boolean',
          'approved' =>  'boolean',
            'cancelled' =>  'boolean',
            'homepage' => 'boolean',
              'lbc_reviewed' =>  'boolean',
                'ensemble' =>  'boolean',
                  'mba' =>  'boolean'
    ];

  public function minicalendars()
  {
    return $this->belongsToMany('emutoday\MiniCalendar', 'cea_event_minicalendar', 'event_id', 'mini_calendar_id');
  }
  /**
   * get a list of the mini calendars associated with this Event
   * @return [Array]
   */
  public function getMiniCalendarListAttribute()
  {
    return $this->minicalendars->lists('id')->all();
  }

  public function eventcategories()
  {
    return $this->belongsToMany('emutoday\Category', 'cea_category_event', 'event_id', 'category_id');
  }


  /**
   * get a list of the categories associated with this Event
   * @return [Array]
   */
  public function getCategoryListAttribute()
  {
    return $this->categories->lists('id')->all();
  }

  public function getStartDateYearAttribute()
  {
    $dt = $this->start_date;
     return $dt->year;
  }

  // public function getStartDateAttribute($value)
  // {
  //   $newval = Carbon::parse($value)->toDateString();
  //   return Carbon::parse($newval);
  // }
  // public function getEndDateAttribute($value)
  // {
  //   return Carbon::parse($value)->toDateString();
  // }

  public function getStartTimeAttribute($value)
  {
    return Carbon::parse($value)->format('g:i A');
  }
  public function getEndTimeAttribute($value)
  {
    return Carbon::parse($value)->format('g:i A');
  }
  public function scopeAfterThisDate($query, $date)
  {

     return $query->where('start_date', '>', $date);
  }
}
