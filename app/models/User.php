<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	/**
	 * User's permissions
	 *
	 * @return mixed
     */
	public function permissions()
	{
		return $this->belongsToMany('Permission')->withTimestamps();
	}


	/**
	 * @param array $permissions
	 * @param bool $requireAll
	 * @return bool
     */
	public function hasPermissions($permissions, $requireAll = false)
	{
		$userPermissions = array_fetch($this->permissions->toArray(), 'slug');

		$hasPermissions = [];

		foreach((array) $permissions as $permission) {
			if (in_array($permission, $userPermissions)) {
				$hasPermissions[] = $permission;
			}
		}

		if ($requireAll) {
			return $hasPermissions == (array) $permissions;
		}

		return ! empty($hasPermissions);
	}

}
