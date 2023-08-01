<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'competition_id'];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function fields() : BelongsToMany
    {
        return $this->belongsToMany(Field::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
