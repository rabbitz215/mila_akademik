<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function semester_subjects()
    {
        return $this->hasMany(SemesterSubject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
