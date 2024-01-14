<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrsSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester_subject()
    {
        return $this->belongsTo(SemesterSubject::class);
    }
}
