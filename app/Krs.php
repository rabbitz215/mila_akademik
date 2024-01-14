<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $guarded = [];

    const NEW_KRS = 0;
    const NEED_APPROVAL_KRS = 1;
    const APPROVED_KRS = 2;

    public function krs_subjects()
    {
        return $this->hasMany(KrsSubject::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == self::NEW_KRS) {
            return 'KRS Baru';
        } else if ($this->status == self::NEED_APPROVAL_KRS) {
            return 'Butuh Approval';
        } else {
            return 'Approved';
        }
    }

    public function getTotalJamAttribute()
    {
        $jam = 0;
        foreach ($this->krs_subjects as $krs_subject) {
            $jam += $krs_subject->semester_subject->hour;
        }

        return $jam;
    }

    public function getTotalSksAttribute()
    {
        $sks = 0;
        foreach ($this->krs_subjects as $krs_subject) {
            $sks += $krs_subject->subject->sks;
        }
        return $sks;
    }

    public function getCalculatedGradeAttribute()
    {
        $total_sks = $this->total_sks;
        $khs = Khs::where('student_id', $this->student_id)->where('semester', $this->semester)->first();

        return $this->calculate_grade($total_sks, $khs);
    }

    public function calculate_grade($total_sks, $khs)
    {
        $grade = 0;
        foreach ($khs->khs_subjects as $khs_subject) {
            $grade += Khs::GRADES[$khs_subject->grade] * $khs_subject->subject->sks;
        }
        $final_grade = $grade / $total_sks;

        return $final_grade;
    }

    public function calculate_all_grade()
    {
        $previous_krss = $this->where('student_id', auth()->user()->student->id)
            ->where('semester', '<=', $this->semester)
            ->orderBy('semester', 'desc')
            ->get();

        $total_grades = 0;

        foreach ($previous_krss as $previous_krs) {
            $total_grades += $previous_krs->calculated_grade;
        }

        return number_format($total_grades, 2) / $previous_krss->count();
    }

    public function getCalculatedAllGradeAttribute()
    {
        return $this->calculate_all_grade();
    }

    public function previousKrs()
    {
        return $this->where('student_id', auth()->user()->student->id)
            ->where('semester', '<', $this->semester)
            ->orderBy('semester', 'desc')
            ->first();
    }

    public function getDosenParentAttribute()
    {
        $dosens = Dosen::get();
        $student_class = $this->student->class;

        // Extracting tingkat and kelas from student_class
        $tingkat = substr($student_class, 0, 1);
        $kelas = substr($student_class, 1);

        // Filter dosens based on the same tingkat and kelas
        $dosensForClass = $dosens->filter(function ($dosen) use ($tingkat, $kelas) {
            return $dosen->kelas->where('tingkat', $tingkat)->where('kelas', $kelas)->isNotEmpty();
        });

        // Extract the names and NIPs of the dosens
        $dosenDetails = $dosensForClass->map(function ($dosen) {
            return [
                'name' => $dosen->name,
                'nip' => $dosen->nip,
            ];
        })->toArray();

        // Now $dosenDetails contains an array with names and NIPs of the dosens who have the same class as the student
        return $dosenDetails;
    }
}
