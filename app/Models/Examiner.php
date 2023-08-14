<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id', 'step_id', 'technique_id',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function technique()
    {
        return $this->belongsTo(Technique::class);
    }
}
