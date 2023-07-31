<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AgeRange extends Model
{
    use HasFactory;

    protected $fillable = ['competition_id', 'title', 'from_date', 'to_date'];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function challenges() : BelongsToMany
    {
        return $this->belongsToMany(Challenge::class);
    }
}
