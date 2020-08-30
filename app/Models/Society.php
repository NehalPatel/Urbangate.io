<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class Society extends Model
{
    use SoftDeletes;

    protected $table = 'soc_societies';
    protected $primaryKey = 'auto_id';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'full_name', 'address', 'area', 'city', 'state', 'country', 'pincode'];

    public static function boot()
    {
        parent::boot();

        Society::creating(function($society)
        {
            $society->society_id = uuid();
            $society->society_no = UniqueNumberHelper::get_no('Society', 'SOC');
            $society->status = $society->status ? $society->status : Status::$DRAFT;
        });
    }

    /**
     * Relationship with Wings
     * Each Society have multiple Wings/Bunglows
     * @return type
     */
    public function Wings()
    {
        return $this->hasMany(Wing::class, 'society_id', 'society_id');
    }

    /**
     * Relationship with Properties
     * Each wing contain multiple flats/bunglows
     * @return type
     */
    public function Properties()
    {
        return $this->hasMany(Property::class, 'society_id', 'society_id');
    }

    public static function get($society_id) {
        return Society::where('society_id', $society_id)->first();
    }

    public static function scopeStored($query) {
        return $query->whereNull('deleted_at');
    }

    public static function scopeSocietyId($query, $society_id) {
        return $query->where('society_id', $society_id);
    }

    public static function scopeSocietyNo($query, $society_no)
    {
        return $query->where('society_no', $society_no);
    }

    public static function scopeName($query, $name) {
        return $query->where('name', $name);
    }

    public static function scopeEmail($query, $email) {
        return $query->where('email', $email);
    }

    public static function scopeType($query, $type) {
        return $query->where('type', $type);
    }

    public static function scopeStatus($query , $status) {
        return $query->where('status', $status);
    }

    public static function scopeState($query, $state) {
        return $query->where('state', $state);
    }

    public static function scopeCity($query, $city) {
        return $query->where('city', $city);
    }

    public static function scopeSearch($query, $term) {
        $searchTerm = '%' . $term . '%';

        return $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', $searchTerm)
            	->orWhere('full_name', 'like', $searchTerm)
            	->orWhere('city', 'like', $searchTerm)
            	->orWhere('state', 'like', $searchTerm)
            	->orWhere('pincode', 'like', $searchTerm);
        });
    }

}
