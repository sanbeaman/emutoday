<?php

namespace emutoday;

use Baum\Node;

class Category extends Node
{
    protected $table = 'categories';

    public function events() {
      return $this->belongsToMany('emutoday\Event', 'category_event');
    }
}
