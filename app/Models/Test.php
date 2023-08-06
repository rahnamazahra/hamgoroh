<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'show_question', 'is_random', 'is_limit', 'is_negative', 'is_score', 'duration', 'easy_count',
        'normal_count', 'hard_count', 'all_count',
    ];
}
