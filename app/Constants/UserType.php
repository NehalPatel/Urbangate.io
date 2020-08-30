<?php

namespace App\Constants;

use Illuminate\Support\Facades\Facade;

class UserTypeFacade extends Facade {
	public static function getFacadeAccessor() {
		return 'UserType';
	}
}

class UserType {
	public static $USER = 'user';
	public static $MEMBER = 'member';
	public static $ADMIN = 'admin';
}
