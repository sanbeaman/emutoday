<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

		public function roles()
		{
			return $this->belongsToMany('emutoday\Role');
		}
}
