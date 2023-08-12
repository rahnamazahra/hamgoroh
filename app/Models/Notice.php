<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'is_sent_users', 'is_sent_referees', 'is_sent_generals', 'is_sent_provincials', 'selected_users',
    ];
}
