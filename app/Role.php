<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  	public function permissions()
		{
			return $this->belongsToMany('emutoday\Permission');
		}

		public function givePermissionTo(Permission $permission)
		{
			return $this->permissions()->save($permission);
		}
}
