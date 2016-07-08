<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Imagetype extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group','type','name','width','height','infotxt', 'helptxt','rules','notes'];

		/**
		 * The one-to-many relationship with storyImages
		 */
		public function storyImages()
	 {
			 return $this->hasMany('emutoday\StoryImage');
	 }
}
