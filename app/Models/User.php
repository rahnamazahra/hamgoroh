<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = ['first_name', 'last_name', 'is_active', 'phone', 'password', 'national_code', 'gender', 'province_id', 'city_id', 'birthday_date', 'meta', 'creator'];
    protected $hidden   = ['password'];
    protected $casts    = ['phone_verified_at' => 'datetime','password' => 'hashed',];

    public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roles)
    {
        return $roles->intersect($this->roles);
    }

    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }

    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function competitions() : HasMany
    {
        return $this->hasMany(Competition::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function evaluation_referee() : HasMany
    {
        return $this->hasMany(EvaluationReferee::class, 'referee_id');
    }

}
