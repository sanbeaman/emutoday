<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
  protected $fillable = ['author_id', 'title', 'announcement', 'start_date', 'end_date', 'is_promoted', 'is_approved'];
  protected $dates = ['end_date', 'start_date'];

}
