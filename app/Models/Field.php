<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'field_group');
    }
}
