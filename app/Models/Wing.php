<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class Wing extends Model
{
    use SoftDeletes;

    protected $table = 'soc_wings';
    protected $primaryKey = 'auto_id';
    protected $dates = ['deleted_at'];
    protected $appends = ['total_flats'];
    protected $fillable = ['name', 'type', 'number_of_floors', 'number_of_flats'];

    public static function boot()
    {
        parent::boot();

        Wing::creating(function($wing)
        {
            $wing->wing_id = uuid();
            $wing->wing_no = UniqueNumberHelper::get_no('Wing', 'WNG');
            $wing->status = $wing->status ? $wing->status : Status::$DRAFT;
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
     * Relationship with Properties
     * Each wing contain multiple flats/bunglows
     * @return type
     */
    public function Properties()
    {
        return $this->hasMany(Property::class, 'wing_id', 'wing_id');
    }

    public static function get($wing_id) {
        return Wing::where('wing_id', $wing_id)->first();
    }

    public static function scopeStored($query) {
        return $query->whereNull('deleted_at');
    }

    public static function scopeWingId($query, $wing_id) {
        return $query->where('wing_id', $wing_id);
    }

    public static function scopeWingNo($query, $wing_no)
    {
        return $query->where('wing_no', $wing_no);
    }

    public static function scopeSocietyId($query, $society_id) {
        return $query->where('society_id', $society_id);
    }

    public static function scopeName($query, $name) {
        return $query->where('name', $name);
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
            $q->where('name', 'like', $searchTerm)
            	->orWhere('type', 'like', $searchTerm);
        });
    }

    public function getTotalFlatsAttribute()
    {
        return $this->number_of_floors * $this->number_of_flats;
    }
}
