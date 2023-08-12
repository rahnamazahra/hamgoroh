<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['step_id', 'criteria_id', 'point', 'refereeing_type'];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function evaluationReferees()
    {
        return $this->hasMany(EvaluationReferee::class);
    }
}
