<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
  protected $fillable = ['year', 'season','title', 'subtitle', 'teaser', 'ext_url', 'is_published', 'is_archived','cover_art', 'start_date', 'end_date', 'user_id'];
  protected $dates = ['start_date'];


  public function storys(){
      return $this->belongsToMany('emutoday\Story')
          ->withPivot('story_position');
  }

  public function storyImages()
  {
      return $this->hasManyThrough('emutoday\StoryImage', 'emutoday\Story');
  }

	public function mediafiles()
	{
			return $this->belongsToMany('emutoday\Mediafile');
	}
}
