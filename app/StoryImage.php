<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use emutoday\Story;

class StoryImage extends Model
{
    protected $fillable = ['story_id',
                            'is_active',
                            'image_name',
                            'image_path',
                            'caption',
                            'teaser',
                            'moretext',
                            'image_extension',
                            'image_type'
    ];
    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
    protected $touches = ['story'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function mainImageURL()
    {
        return $this->image_path . $this->filename;
    }
    
    public function thumbnailImageURL()
    {
        return $this->image_path . 'thumbnails/thumb-' . $this->filename;
    }
}
