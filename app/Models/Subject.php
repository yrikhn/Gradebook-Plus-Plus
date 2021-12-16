<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $with = ['grade'];

    protected $appends = ['average_grade'];

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function getAverageGradeAttribute()
    {
        return $this->attributes['average_grade'] = round($this->grade->avg('grade'), 2);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'subject_id');
    }

}
