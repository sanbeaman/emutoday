<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use emutoday\StoryImage;
use Laracasts\Presenter\PresentableTrait;

class Story extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'storys';


    use PresentableTrait;
    protected $presenter = 'emutoday\Presenters\StoryPresenter';
    /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
    protected $fillable = ['user_id', 'title', 'slug','subtitle', 'teaser', 'content', 'external_link', 'start_date','end_date', 'is_featured','is_approved', 'is_live' ,'story_type','author_id','author_info'];

    protected $dates = ['start_date', 'end_date'];




    public function addImage($stype)
    {

        return $this->storyImages()->create([
            'image_name'=> 'img' . $this->id . '_'. $stype,
            'image_type'=> 'image'.$stype,
        ]);
        // $storyImage = $story->storyImages()->create([
        //         'image_name'=> 'img' . $story->id . '_hero',
        //         'image_type'=> 'imagehero',
        //     ]);
    }

    /**
     * [setPublishedAtAttribute description]
     * @param [type] $value [description]
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ?: null;
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
    public function user()
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
        public function images()
        {
                return $this->hasMany('emutoday\StoryImage');
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
     * get a list of the tags associated with this Story
     * @return [Array]
     */
    public function getTagListAttribute()
    {
      return $this->tags->lists('id')->all();
    }


    public function getPrettyStartDateAttribute()
    {
      return $this->start_date->toDateString();
    }
    public function getPrettyEndDateAttribute()
    {
      return $this->end_date->toDateString();
    }

    public function getStoryFolderAttribute()
    {

      switch ($this->story_type) {
          case 'news':
            $type = 'news';
            break;
          case 'story':
            $type = 'story';
            break;
          case 'student':
            $type = 'student';
            break;
          case 'magazine':
            $type = 'magazine';
            break;
          case 'external':
            $type = 'external';
            break;
          default:
            $type = $this->story_type;
          }

          return $type;

    }

    /**
     * [storyTypes description]
     * @return [type] [description]
     */
    public function storyType()
    {
        return $this->belongsTo('emutoday\StoryType', 'story_type', 'shortname');
    }

        public function storyGroup()
        {
                return $this->belongsTo('emutoday\StoryType', 'story_type', 'shortname');
        }

    /**
     * Inverse Many-to-Many relationship for page layouts
     * @return [type] [description]
     */
    public function pages()
    {
        return $this->belongsToMany('emutoday\Page');
    }

    public function magazine()
    {
      return $this->belongsToMany('emutoday\Magazine');
    }

    /** ************* QUERY SCOPES ************** */
    /**
     * Scope a query by story_type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('story_type', $type);
    }

        public function scopeOfStoryType($query, $group)
        {
                return $query->storyType->where('group', $group);

                // where('story_type', $type);
        }


}
