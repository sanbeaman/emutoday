<?php

namespace emutoday\Emutoday\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class DDFront implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(200, 100);
    }
}
