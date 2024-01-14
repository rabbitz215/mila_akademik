<?php

namespace App\Http\Controllers;

use App\SemesterSubject;
use App\StudyProgram;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Program Studi';
        $study_programs = StudyProgram::paginate(10);
        return view('study_program.list', compact('study_programs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study_program.create', [
            'title' => 'Program Studi Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $study_program = new StudyProgram();
            $study_program->fill($request->except([]));
            $study_program->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollBack();
        }

        return redirect()->route('study_programs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyProgram $studyProgram)
    {
        $title = 'Detail Program Studi ' . $studyProgram->name;
        return view('study_program.show', compact('studyProgram', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyProgram $studyProgram)
    {
        return view('study_program.edit', [
            'title' => 'Edit Program Studi',
            'study_program' => $studyProgram,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyProgram $studyProgram)
    {
        $studyProgram->fill($request->except([]));
        $studyProgram->save();

        return redirect()->route('study_programs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->semester_subjects()->delete();
        $studyProgram->delete();

        return redirect()->route('study_programs.index')->with('message', 'Program Studi deleted successfully');
    }

    public function create_semester_subject($study_program)
    {
        $title = 'Tambah Mata Kuliah Prodi';
        $studyProgram = StudyProgram::find($study_program);
        $semester_subject = new SemesterSubject();
        return view('study_program.create_semester_subject', compact('title', 'studyProgram', 'semester_subject'));
    }

    public function store_semester_subject(Request $request)
    {
        $semester_subject = new SemesterSubject();
        $semester_subject->fill($request->except([]));
        $semester_subject->save();

        return redirect()->route('study_programs.show', $request->study_program_id)->with('message', 'Mata Kuliah Berhasil Ditambah');
    }

    public function edit_semester_subject($semester_subject)
    {
        $title = 'Edit Mata Kuliah Prodi';
        $semester_subject = SemesterSubject::find($semester_subject);
        return view('study_program.edit_semester_subject', compact('title', 'semester_subject'));
    }

    public function update_semester_subject(Request $request, $semester_subject)
    {
        $semester_subject = SemesterSubject::find($semester_subject);
        $semester_subject->fill($request->except([]));
        $semester_subject->save();

        return redirect()->route('study_programs.show', $semester_subject->study_program->id);
    }

    public function destroy_semester_subject($semester_subject)
    {
        $semester_subject = SemesterSubject::find($semester_subject);
        $semester_subject->delete();

        return redirect()->route('study_programs.show', $semester_subject->study_program->id)->with('messsage', 'Mata Kuliah Berhasil dihapus');
    }
}
