<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = ['age_id', 'field_id', 'gender', 'nationality', 'start_time', 'finish_time', 'result_start_time', 'result_finish_time'];

    public function age()
    {
        return $this->belongsTo(AgeRange::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
