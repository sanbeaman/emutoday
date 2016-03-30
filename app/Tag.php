<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * Get the manyToMany relationship from Story
     * @return [type] [description]
     */
    public function storys()
    {
        return $this->belongsToMany('emutoday\Story', "story_tag");
    }
}
