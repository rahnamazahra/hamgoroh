<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function groups() : BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withPivot('competition_id');
    }

    public function challenges() : HasMany
    {
        return $this->hasMany(Challenge::class);
    }
}
