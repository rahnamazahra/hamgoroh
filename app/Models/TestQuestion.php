<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id' , 'title' , 'correct_answer' , 'ancillary_answer' , 'option_one' , 'option_two' , 'option_three' ,
        'option_four' , 'level' , 'duration' ,
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
