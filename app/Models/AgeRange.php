<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeRange extends Model
{
    use HasFactory;
    protected $fillable = ['challenge_id', 'title', 'from_date', 'to_date'];
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
