<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class Setting extends Model
{
	use SoftDeletes;

	protected $table = 'ug_settings';
	protected $primaryKey = 'auto_id';
	protected $hidden = ['auto_id'];
	protected $dates = ['deleted_at'];
	protected $appends = ['photo'];

	public static function boot() {
		parent::boot();

		Setting::creating(function($setting) {
			$setting->setting_id = uuid();
			$setting->setting_no = UniqueNumberHelper::get_no('Setting', 'STG');

			if(!$setting->status) {
				$setting->status = Status::$ACTIVE;
			}
		});
	}

	public static function get($setting_id) {
		return Setting::where('setting_id', $setting_id)->first();
	}

	public static function scopeStored($query) {
		return $query->whereNull('deleted_at');
	}

	public static function scopeSettingId($query, $setting_id) {
		return $query->where('setting_id', $setting_id);
	}

	public static function scopeSettingNo($query, $setting_no)
	{
		return $query->where('setting_no', $setting_no);
	}

	public static function scopeName($query, $name)
	{
		return $query->where('name', $name);
	}

	public static function scopeValue($query, $value)
	{
		return $query->where('value', $value);
	}

	public static function scopeType($query, $type) {
		return $query->where('type', $type);
	}

	public static function scopeStatus($query , $status) {
		return $query->where('status', $status);
	}

	public static function get_settings()
	{
		$settings = [];
		$settings_row = self::stored()->get();

		foreach ($settings_row as $key => $setting) {
			$settings[$setting['name']] = $setting['value'];
		}

		return $settings;
	}
}