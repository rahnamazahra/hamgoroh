<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Examiner extends Model
{
    use HasFactory;

    protected $fillable = ['participant_id', 'step_id', 'technique_id', 'score'];

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

    public function scores() : HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function getUser()
    {
        return $this->participant->user;
    }
     public function field()
    {
        return $this->belongsTo(Field::class);
    }

}
