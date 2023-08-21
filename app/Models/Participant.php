<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'competition_id', 'field_id', 'challenge_id', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
