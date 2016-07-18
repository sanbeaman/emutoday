<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Announcement extends Model
{
  use PresentableTrait;
  protected $presenter = 'emutoday\Presenters\AnnouncementPresenter';
  protected $fillable = ['author_id', 'title', 'announcement', 'start_date', 'end_date', 'is_promoted', 'is_approved'];
  protected $dates = ['end_date', 'start_date', 'submission_date', 'approved_date'];


	public function author()
	{
		return $this->belongsTo('emutoday\User');
	}
}
