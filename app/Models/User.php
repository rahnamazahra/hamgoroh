<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = ['first_name', 'last_name', 'is_active', 'phone', 'password', 'national_code', 'gender', 'city_id', 'birthday_date', 'meta', 'creator'];
    protected $hidden   = ['password'];
    protected $casts    = ['phone_verified_at' => 'datetime','password' => 'hashed',];

    public function roles()
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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
