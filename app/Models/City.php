<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'provience_id'];

    public function provience()
    {
        return $this->belongsTo(Provience::class);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }
}
