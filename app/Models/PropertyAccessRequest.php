<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class PropertyAccessRequest extends Model
{
    use SoftDeletes;

    protected $table = 'soc_property_access_request';
    protected $primaryKey = 'auto_id';
    protected $dates = ['requested_at','authorized_at','deleted_at'];
    protected $fillable = ['user_id', 'society_id', 'wing_id', 'property_id'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        PropertyAccessRequest::creating(function($requestPermission)
        {
            $requestPermission->property_access_request_id = uuid();
            $requestPermission->property_access_request_no = UniqueNumberHelper::get_no('PropertyAccessRequest', 'PAR');
            $requestPermission->status = $requestPermission->status ?? Status::$PENDING;
        });
    }

    public static function get($property_access_request_id) {
        return PropertyAccessRequest::where('property_access_request_id', $property_access_request_id)->first();
    }

    public static function scopeStored($query) {
        return $query->whereNull('deleted_at');
    }

    public static function scopePropertyAccessRequestId($query, $property_access_request_id) {
        return $query->where('property_access_request_id', $property_access_request_id);
    }

    public static function scopePropertyAccessRequestNo($query, $property_access_request_no)
    {
        return $query->where('property_access_request_no', $property_access_request_no);
    }

    public static function scopeUserId($query, $user_id) {
        return $query->where('user_id', $user_id);
    }

    public static function scopeSocietyId($query, $society_id) {
        return $query->where('society_id', $society_id);
    }

    public static function scopeWingId($query, $wing_id) {
        return $query->where('wing_id', $wing_id);
    }

    public static function scopePropertyId($query, $property_id) {
        return $query->where('property_id', $property_id);
    }

    public static function scopeStatus($query , $status) {
        return $query->where('status', $status);
    }

    public static function scopeSearch($query, $term) {
        $searchTerm = '%' . $term . '%';

        return $query->where(function($q) use ($searchTerm) {
            $q->where('property_access_request_id', 'like', $searchTerm)
            	->orWhere('property_access_request_no', 'like', $searchTerm);
        });
    }
}
