<?php

namespace emutoday;

use Baum\Node;

class Category extends Node
{
    protected $table = 'cea_categories';

    
    public function events() {
      return $this->belongsToMany('emutoday\Event', 'cea_category_event');
    }
}
