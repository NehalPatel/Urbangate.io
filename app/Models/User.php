<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

use App\Constants\Status;
use App\Helpers\UniqueNumberHelper;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    protected $table = 'users';
    protected $appends = ['photo','full_name'];
    protected $primaryKey = 'auto_id';
    protected $dates = ['deleted_at'];
    protected $hidden = ['id', 'password', 'remember_token'];
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'avatar'];
    protected $casts = ['email_verified_at' => 'datetime'];

    Protected $guard_name ='web';

    public static function boot()
    {
        parent::boot();

        User::creating(function($user)
        {
            $user->user_id = uuid();
            $user->user_no = UniqueNumberHelper::get_user_no($user->type);
            $user->status = $user->status ? $user->status : Status::$DRAFT;
        });
    }

    public static function get_all()
    {
        return User::orderBy('id', 'asc')->get();
    }

    public static function get($user_id)
    {
        return User::where('user_id' , $user_id)->first();
    }

    public static function scopeUserType($query, $type)
    {
        if(is_array($type))
        {
            return $query->whereIn('type' , $type);
        }
        return $query->where('type' , $type);
    }

    public static function scopeStored($query)
    {
        return $query->whereNull('deleted_at');
    }

    public static function scopeEmail($query , $email)
    {
        return $query->where('email', $email);
    }

    public static function scopeUserId($query , $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public static function scopeStatus($query , $status)
    {
        return $query->where('status', $status);
    }

    public static function scopeUserNo($query , $user_no)
    {
        return $query->where('user_no', $user_no);
    }

    public static function scopeSearch($query, $term)
    {
        $search_term = '%' . $term . '%';

        return $query->where(function($q) use ($search_term)
        {
            $q->where('first_name', 'like', $search_term)->orWhere('email', 'like', $search_term)->orWhere('user_no', 'like', $search_term);
        });
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) .' ' . ucfirst($this->last_name);
    }

    public function getPhotoAttribute()
    {
        if($this->photo_id)
        {
            return AttachmentHelper::renderUrl($this->photo_id);

        }else if($this->avatar)
        {
            return $this->avatar;
        }

        return asset('assets/panel/app/assets/images/default-placeholder.png');
    }

    public function setNameAttribute($value)
    {
        $name = explode(' ',trim($value));
        $first_name = $name[0];
        $this->attributes['first_name'] = ucfirst($first_name);

        $last_name = $name[1]??'';
        $this->attributes['last_name'] = ucfirst($last_name);
    }

}
