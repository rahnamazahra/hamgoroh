<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $fillable = ['challenge_id', 'title', 'weight', 'level','type','group'];
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function examiners()
    {
        return $this->hasMany(Examiner::class);
    }
}
