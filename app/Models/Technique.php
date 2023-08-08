<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technique extends Model
{
    use HasFactory;

    protected $fillable = ['challenge_id', 'title', 'description'];
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
