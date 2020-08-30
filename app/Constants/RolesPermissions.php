<?php

namespace App\Constants;

use Illuminate\Support\Facades\Facade;

class RolesPermissionsFacade extends Facade {
	public static function getFacadeAccessor() {
		return 'RolesPermissions';
	}
}

class RolesPermissions {

	public static $GUARDS = ['web', 'admin'];

	public static $ADMIN_ROLES = [
		'SUPER_ADMIN' 		=> 'Super Admin',
	];

	public static $ROLES = [
		'ADMIN'				=> 'Admin',
		'SOCIETY_PRESIDENT'	=> 'Society President',
		'SOCIETY_TRESERER'	=> 'Society Treserer',
		'COMMITTEE_MEMBER'	=> 'Committee Member',
		'FLAT_OWNER'		=> 'Flat Owner',
		'FLAT_OWNER_MEMBER'	=> 'Flat Owner Member',
		'FLAT_TENANT'		=> 'Flat Tenant',
		'VENDOR'			=> 'Vendor',
		'GUEST'				=> 'Guest',
	];

	public static $PERMISSIONS = [
		'admin' => [
			'admin_create'	=> 'ADMIN CREATE',
			'admin_update' 	=> 'ADMIN UPDATE',
			'admin_delete' 	=> 'ADMIN DELETE',
			'admin_view'  	=> 'ADMIN VIEW',
		],
		'user' => [
			'user_create' 	=> 'USER CREATE',
			'user_update' 	=> 'USER UPDATE',
			'user_delete' 	=> 'USER DELETE',
			'user_view'  	=> 'USER VIEW',
		],
		'role' => [
			'role_create' 	=> 'ROLE CREATE',
			'role_update' 	=> 'ROLE UPDATE',
			'role_delete' 	=> 'ROLE DELETE',
			'role_view' 	=> 'ROLE VIEW',
		],
		'permission' => [
			'permission_create'	=> 'PERMISSION CREATE',
			'permission_update' => 'PERMISSION UPDATE',
			'permission_delete' => 'PERMISSION DELETE',
			'permission_view' 	=> 'PERMISSION VIEW',
		],
		'page' => [
			'page_create' 	=> 'PAGE CREATE',
			'page_update' 	=> 'PAGE UPDATE',
			'page_delete' 	=> 'PAGE DELETE',
			'page_view' 	=> 'PAGE VIEW',
		],
		'gallery' => [
			'gallery_create' 	=> 'GALLERY CREATE',
			'gallery_update' 	=> 'GALLERY UPDATE',
			'gallery_delete' 	=> 'GALLERY DELETE',
			'gallery_view' 		=> 'GALLERY VIEW',
		],
		'contacts' => [
			'contact_delete' 	=> 'CONTACT DELETE',
			'contact_view' 		=> 'CONTACT VIEW',
		],
		'settings' => [
			'settings_update' 	=> 'SETTINGS UPDATE/ADD',
			'settings_view' 	=> 'SETTINGS VIEW',
		],
	];
}