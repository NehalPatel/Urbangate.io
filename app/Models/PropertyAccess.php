<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class PropertyAccess extends Model
{
    use SoftDeletes;

    protected $table = 'soc_property_access';
    protected $primaryKey = 'auto_id';
    protected $fillable = ['user_id', 'property_id', 'access_type'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        PropertyAccess::creating(function($property_access)
        {
            $property_access->property_access_id = uuid();
            $property_access->property_access_no = UniqueNumberHelper::get_no('PropertyAccess', 'PAC');
        });
    }

    public static function get($property_access_id) {
        return PropertyAccess::where('property_access_id', $property_access_id)->first();
    }

    public static function scopeStored($query) {
        return $query->whereNull('deleted_at');
    }

    public static function scopePropertyAccessId($query, $property_access_id) {
        return $query->where('property_access_id', $property_access_id);
    }

    public static function scopePropertyAccessNo($query, $property_access_no)
    {
        return $query->where('property_access_no', $property_access_no);
    }

    public static function scopeUserId($query, $user_id) {
        return $query->where('user_id', $user_id);
    }

    public static function scopePropertyId($query, $property_id) {
        return $query->where('property_id', $property_id);
    }

    public static function scopeSearch($query, $term) {
        $searchTerm = '%' . $term . '%';

        return $query->where(function($q) use ($searchTerm) {
            $q->where('property_access_id', 'like', $searchTerm)
            	->orWhere('property_access_no', 'like', $searchTerm);
        });
    }
}
