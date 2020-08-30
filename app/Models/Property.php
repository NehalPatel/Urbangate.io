<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class Property extends Model
{
    use SoftDeletes;

    protected $table = 'soc_properties';
    protected $primaryKey = 'auto_id';
    protected $dates = ['deleted_at'];
    protected $hidden = ['auto_id'];
    protected $fillable = ['name', 'type', 'property_number', 'floor_number','type','property_location','size_sqft'];

    public static function boot()
    {
        parent::boot();

        Property::creating(function($property)
        {
            $property->property_id = uuid();
            $property->property_no = UniqueNumberHelper::get_no('Property', 'PRO');
            $property->status = $property->status ? $property->status : Status::$DRAFT;
        });
    }

    /**
     * Relationship with Society Table
     * Every wing belongs from only one Society
     * @return type
     */
    public function Society()
    {
        return $this->belongsTo(Society::class, 'society_id', 'society_id');
    }

    /**
     * Relationship with Society Table
     * Every wing belongs from only one Society
     * @return type
     */
    public function Wing()
    {
        return $this->belongsTo(Wing::class, 'wing_id', 'wing_id');
    }

    public static function get($property_id) {
        return Property::where('property_id', $property_id)->first();
    }

    public static function scopeStored($query) {
        return $query->whereNull('deleted_at');
    }

    public static function scopePropertyId($query, $property_id) {
        return $query->where('property_id', $property_id);
    }

    public static function scopePropertyNo($query, $property_no)
    {
        return $query->where('property_no', $property_no);
    }

    public static function scopeSocietyId($query, $society_id) {
        return $query->where('society_id', $society_id);
    }

    public static function scopeWingId($query, $wing_id) {
        return $query->where('wing_id', $wing_id);
    }

    public static function scopePropertyNumber($query, $property_number)
    {
        return $query->where('property_number', $property_number);
    }

    public static function scopeType($query, $type) {
        return $query->where('type', $type);
    }

    public static function scopeStatus($query , $status) {
        return $query->where('status', $status);
    }

    public static function scopeSearch($query, $term) {
        $searchTerm = '%' . $term . '%';

        return $query->where(function($q) use ($searchTerm) {
            $q->where('property_number', 'like', $searchTerm)
            	->orWhere('floor_number', 'like', $searchTerm);
        });
    }

}
