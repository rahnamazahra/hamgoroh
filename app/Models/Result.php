<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id', 'examiner_id', 'evaluation_id', 'referee_id', 'step_id', 'score',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function examiner()
    {
        return $this->belongsTo(Examiner::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function referee()
    {
        return $this->belongsTo(User::class);
    }

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
}
