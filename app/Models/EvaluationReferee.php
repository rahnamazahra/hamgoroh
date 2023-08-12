<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationReferee extends Model
{
    use HasFactory;
    protected $fillable = ['evaluation_id', 'referee_id'];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

}
