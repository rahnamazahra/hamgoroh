<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;
    protected $fillable = ['step_id','age_id','gender','nationality'];
    public function step()
    {
        return $this->belongsTo(Step::class);
    }
    public function age()
    {
        return $this->belongsTo(AgeRange::class);
    }
}
