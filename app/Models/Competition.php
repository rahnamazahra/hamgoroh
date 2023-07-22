<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'is_active', 'registration_start_time', 'registration_finish_time',
        'registration_description', 'rules_description', 'letter_method', 'banner', 'creator'];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }
}
