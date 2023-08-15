<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id', 'user_id', 'is_reserved', 'from_time', 'to_time',
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
