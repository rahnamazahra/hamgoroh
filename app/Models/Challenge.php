<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = ['competition_id', 'field_id', 'start_time', 'finish_time', 'registration_start_time', 'registration_finish_time'];
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
