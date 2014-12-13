<?php

class Permission extends \Eloquent {

	public function users()
	{
		return $this->hasMany('User')->withTimestamps();
	}

}
