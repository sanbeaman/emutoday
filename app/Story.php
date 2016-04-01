<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use emutoday\StoryImage;

class Story extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'storys';

    /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
    protected $fillable = ['author_id', 'title', 'slug','subtitle', 'teaser', 'content','publish_start','publish_end', 'is_featured', 'is_live' ,'story_type'];

    protected $dates = ['publish_start', 'publish_end'];

    /**
     * [setPublishedAtAttribute description]
     * @param [type] $value [description]
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['publish_start'] = $value ?: null;
    }

    /**
     * [grabStoryImageByType description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function grabStoryImageByType($value)
    {
        return $storyImage = $this->storyImages()->where('image_type', $value)->first();
    }

    /**
     * [author description]
     * @return [type] [description]
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [storyImages description]
     * @return [type] [description]
     */
    public function storyImages()
    {
        return $this->hasMany(StoryImage::class);
    }

    /**
     * [tags description]
     * @return [type] [description]
     */
    public function tags()
    {
        return $this->belongsToMany('emutoday\Tag', "story_tag")->withTimestamps();
    }

    /**
     * [storyTypes description]
     * @return [type] [description]
     */
    public function storyType()
    {
        return $this->belongsTo('emutoday\StoryType', 'story_type');
    }




}
