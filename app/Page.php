<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

     protected $fillable = ['template', 'uri', 'start_date', 'end_date', 'user_id'];
     
    public function storys(){
        return $this->belongsToMany('emutoday\Storys')
            ->withPivot('page_position', 'note')
            ->withTimestamps();
    }
}
