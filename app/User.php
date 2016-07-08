<?php

namespace emutoday;

use Illuminate\Foundation\Auth\User as Authenticatable;
use emutoday\Mediafile;

class User extends Authenticatable
{
		use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'phone', 'email', 'password'];

    protected $dates = ['last_login_at'];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

		public function mediaFiles()
		{
			return $this->belongsToMany('emutoday\Mediafile');
		}


	
		// public function avatarImgUrl()
		// {
		// 	$mfile = $this->belongsToMany('emutoday\Mediafile')->first();
		// 	//dd($this->mediaFiles()->first());
		// 	 return $mfile->path . $mfile->name .'.'.$mfile->ext;
		// }


}
