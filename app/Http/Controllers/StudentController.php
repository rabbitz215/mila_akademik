<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Khs;
use App\KhsSubject;
use App\Krs;
use App\KrsSubject;
use App\Setting;
use App\Student;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['krss'])->get();
        $title = 'Mahasiswa';

        return view('student.list', compact('students', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create', [
            'title' => 'Mahasiswa Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $student = new Student();
            $student->fill($request->except(['email', 'password']));
            $student->save();



            DB::commit();
        } catch (QueryException $ex) {
            DB::rollBack();
        }

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('student.edit', [
            'title' => 'Edit Mahasiswa',
            'student' => $student,
            'user' => $student->user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        if ($request->filled('password')) {
            $student->user->password = Hash::make($request->password);
        }

        $student->nim = $request->nim;
        $student->name = $request->name;
        $student->save();

        $student->user->email = $request->email;
        $student->user->save();

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->user()->delete();
        $student->delete();

        return redirect()->route('students.index')->with('message', 'Mahasiswa deleted successfully!');
    }

    public function acak_kelas()
    {
        $students = Student::all();
        $currentYear = (int) Setting::where('key', 'ACADEMIC_YEAR')->value('value');
        $kelasVariants = Kelas::all();
        $groupedStudents = $students->groupBy('nim');

        foreach ($groupedStudents as $nimGroup) {
            $nimYear = substr($nimGroup->first()->nim, 0, 2);

            // Check if the nimYear is more than 4 years apart from the current year
            if ($currentYear - $nimYear > 4) {
                foreach ($nimGroup as $student) {
                    $student->update(['class' => null]);
                }
                continue;
            } else if ($currentYear - $nimYear < 0) {
                foreach ($nimGroup as $student) {
                    $student->update(['class' => null]);
                }
                continue;
            }

            $tingkat = max(1, min(4, $currentYear - $nimYear + 1));

            if ($tingkat < 1 || $tingkat > 4) {
                foreach ($nimGroup as $student) {
                    $student->update(['class' => null]);
                }
                continue;
            }

            $tingkatKelasVariants = $kelasVariants->where('tingkat', (string)$tingkat);

            if ($tingkatKelasVariants->count() < 1) {
                foreach ($nimGroup as $student) {
                    $student->update(['class' => null]);
                }
                continue;
            }

            $tingkatKelasVariants = $tingkatKelasVariants->shuffle();
            $studentsPerVariant = min(25, $tingkatKelasVariants->count());
            $index = 0;

            foreach ($nimGroup as $student) {
                if ($currentYear - $nimYear > 4) {
                    $student->update(['class' => null]);
                } else {
                    $kelasVariant = optional($tingkatKelasVariants->get($index % $studentsPerVariant))->kelas;

                    if ($kelasVariant !== null) {
                        $student->update(['class' => "$tingkat$kelasVariant"]);
                    } else {
                        $student->update(['class' => null]);
                    }

                    $index = ($index + 1) % $studentsPerVariant;
                }
            }
        }

        return redirect()->route('students.index');
    }

    public function make_krs(Request $request, Student $student)
    {
        $check_krs = $student->krss->where('semester', $request->semester);
        if (!$check_krs->isEmpty()) {
            return redirect()->route('students.index')->with('error', 'KRS untuk semester tersebut telah dibuat');
        }

        $semester_subjects = $student->study_program->semester_subjects->where('semester', $request->semester);
        if ($semester_subjects->isEmpty()) {
            return redirect()->route('students.index')->with('error', 'Tidak ada mata kuliah');
        }

        $previous_status = $student->krss->every(function ($krss) {
            return $krss->status == 1 || $krss->status == 2;
        });

        if (!$previous_status) {
            return redirect()->route('students.index')->with('error', 'Ada KRS yang belum disetujui');
        }

        $krs = new Krs();
        $krs->student_id = $student->id;
        $krs->semester = $request->semester;
        $krs->status = 0;
        $krs->save();

        foreach ($semester_subjects as $subject) {
            $krs_subject = new KrsSubject();
            $krs_subject->krs_id = $krs->id;
            $krs_subject->subject_id = $subject->subject_id;
            $krs_subject->status = 0;
            $krs_subject->semester_subject_id = $subject->id;
            $krs_subject->save();
        }

        return redirect()->route('students.index')->with('message', 'KRS Berhasil Dibuat');
    }

    public function make_khs(Request $request, Student $student)
    {
        $semester_subjects = $student->krss->where('semester', $request->semester)->first()->krs_subjects;
        if ($semester_subjects->isEmpty()) {
            return redirect()->route('students.index')->with('error', 'Tidak ada mata kuliah');
        }

        $previous_status = $student->khss->where('semester', $request->semester);
        if ($previous_status->count() > 0) {
            return redirect()->route('students.index')->with('error', 'Sudah terdapat KHS untuk semester tersebut');
        }

        $khs = new Khs();
        $khs->student_id = $student->id;
        $khs->semester = $request->semester;
        $khs->status = 0;
        $khs->save();

        foreach ($semester_subjects as $subject) {
            $khs_subject = new KhsSubject();
            $khs_subject->khs_id = $khs->id;
            $khs_subject->subject_id = $subject->subject_id;
            $khs_subject->save();
        }

        return redirect()->route('students.index')->with('message', 'KHS Berhasil Dibuat');
    }
}
