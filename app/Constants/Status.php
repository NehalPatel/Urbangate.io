<?php

namespace App\Constants;

use Illuminate\Support\Facades\Facade;

class StatusFacade extends Facade {
	public static function getFacadeAccessor() {
		return 'Status';
	}
}

class Status {
	public static $DRAFT = '10';
	public static $ACTIVE = '20';
	public static $INACTIVE = '30';
	public static $PENDING = '40';
	public static $COMPLETED = '50';
	public static $REJECTED = '60';
	public static $DEPLOYING = '70';
	public static $APPROVED = '80';

	public static $ALL = [
		'10' => 'Draft',
		'20' => 'Active',
		'30' => 'Inactive',
		'40' => 'Pending',
		'50' => 'Completed',
		'60' => 'Rejected',
		'70' => 'Deploying',
		'80' => 'Approved',
	];

	public static $CLASS = [
		'10' => 'default',
		'20' => 'success',
		'30' => 'danger',
		'40' => 'warning',
		'50' => 'success',
		'60' => 'danger',
		'70' => 'warning',
		'80' => 'success',
	];
}
