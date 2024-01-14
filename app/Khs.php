<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    protected $guarded = [];

    const GRADES = [
        'A' => 4,
        'B+' => 3.5,
        'B' => 3,
        'C+' => 2.5,
        'D' => 1,
    ];

    public function khs_subjects()
    {
        return $this->hasMany(KhsSubject::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getCalculatedGradeAttribute()
    {
        $total_sks = $this->calculate_total_sks($this);

        return $this->calculate_grade($total_sks, $this);
    }

    public function calculate_total_sks($khs)
    {
        $total_sks = 0;
        foreach ($khs->khs_subjects as $khs_subject) {
            $total_sks += $khs_subject->subject->sks;
        }
        return $total_sks;
    }

    public function calculate_grade($total_sks, $khs)
    {
        $grade = 0;
        foreach ($khs->khs_subjects as $khs_subject) {
            $grade += self::GRADES[$khs_subject->grade] * $khs_subject->subject->sks;
        }
        $final_grade = $grade / $total_sks;

        return $final_grade;
    }

    public function getTotalSksAttribute()
    {
        $sks = 0;

        foreach ($this->khs_subjects as $khs_subject) {
            $sks += $khs_subject->subject->sks;
        }

        return $sks;
    }

    public function previousKhs($student_id)
    {
        return $this->where('student_id', $student_id)
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function isLulus()
    {
        return !$this->khs_subjects->contains('grade', 'D');
    }

    public function getRomanizeSemesterAttribute()
    {
        $semesterNumber = $this->semester;

        // Define an array to map semester numbers to Roman numerals
        $romanNumerals = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII'];

        // Ensure the semester number is within the valid range (1-8)
        if ($semesterNumber >= 1 && $semesterNumber <= 8) {
            return $romanNumerals[$semesterNumber - 1];
        }

        // Return an empty string or handle out-of-range values as needed
        return '';
    }
}
