<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;
use Auth;
use Request;

use App\Models\User;
use App\Models\Admin;

use App\Constants\Status;
use App\Constants\UserType;

class UniqueNumberHelperFacade extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'UniqueNumberHelper';
	}
}

class UniqueNumberHelper
{
	/**
	 * Function to generate unique number for Web:Gate
	 * @param type $type
	 * @return type
	 */
	public static function get_user_no($type)
	{
		$prefix = 'USR';

		if($type == UserType::$ADMIN)
		{
			$prefix = 'ADM';
		}

		$user_no = $prefix . '-' . UniqueNumberHelper::get_entity_no();
		$user = User::userNo($user_no)->first();

		if($user)
		{
			return UniqueNumberHelper::get_user_no($type);
		}
		else
		{
			return $user_no;
		}
	}

	/**
	 * Function to generate unique number for Admin:Gate
	 * @param type $type
	 * @return type
	 */
	public static function get_admin_no()
	{
		$prefix = 'ADM';

		$admin_no = $prefix . '-' . UniqueNumberHelper::get_entity_no();
		$admin = Admin::adminNo($admin_no)->first();

		if($admin)
		{
			return UniqueNumberHelper::get_admin_no();
		}
		else
		{
			return $admin_no;
		}
	}

	public static function get_no( $entity, $prefix )
	{
		$class = 'App\\Models\\' . $entity;
		$method = $entity.'No';

		$entity_no = $prefix . '-' . UniqueNumberHelper::get_entity_no();
		$entity = $class::$method($entity_no)->first();

		if($entity)
		{
			return UniqueNumberHelper::get_no($entity, $prefix);
		}
		else
		{
			return $entity_no;
		}
	}

	public static function get_reset_password_no()
	{
		$password_token = uuid();
		$user = User::passwordToken($password_token)->first();

		if($user)
		{
			return UniqueNumberHelper::get_reset_password_no();
		}
		else
		{
			return $password_token;
		}
	}

	public static function get_entity_no()
	{
		return mt_rand(1000 , 9999).'-'.mt_rand(1000 , 9999).'-'.mt_rand(1000 , 9999);
	}
}
