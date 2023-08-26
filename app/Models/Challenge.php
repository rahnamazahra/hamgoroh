<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = ['age_id', 'field_id', 'gender', 'nationality', 'start_time', 'finish_time', 'result_start_time', 'result_finish_time', 'description'];

    public function age()
    {
        return $this->belongsTo(AgeRange::class, 'age_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function techniques()
    {
        return $this->hasMany(Technique::class);
    }

    public function getCompetition()
    {
        return $this->age->competition;
    }

    public function challengeName()
    {
        switch ($this->gender)
        {
            case '0':
                $gender = 'خواهران';
                break;

            case '1':
                $gender = 'برادران';
                break;

            default:
                $gender = '';
                break;
        }

        switch ($this->nationality)
        {
            case '0':
                $nationality = 'ایرانی';
                break;

            case '1':
                $nationality = 'خارجی';
                break;

            default:
                $nationality = '';
                break;
        }

        $field = $this->field->title;
        $age = $this->age->title;

        return $field.' '.$gender.' '.$nationality.' '.$age;
    }
}
