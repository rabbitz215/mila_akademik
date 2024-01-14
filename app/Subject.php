<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function semester_subjects()
    {
        return $this->hasMany(SemesterSubject::class);
    }

    public function krs_subjects()
    {
        return $this->hasMany(KrsSubject::class);
    }

    public function khs_subjects()
    {
        return $this->hasMany(KhsSubject::class);
    }
}
