<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['examiner_id', 'criteria_id', 'referee_id', 'score'];

    public function examiner() : BelongsTo
    {
        return $this->belongsTo(Examiner::class);
    }

    public function criteria() : BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function referee() : BelongsTo
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

}
