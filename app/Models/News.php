<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'title', 'sub_title', 'preview', 'body', 'is_published'
    ];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_tags');
    }
}
