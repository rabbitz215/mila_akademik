<?php

namespace App\Http\Controllers;

use App\Krs;
use App\KrsSubject;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $krss = Krs::get();
        $title = 'List KRS Mahasiswa';
        return view('krs.list', compact('title', 'krss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Krs $krs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Krs $krs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Krs $krs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Krs $krs)
    {
        //
    }

    public function dosen($kelas)
    {
        $title = 'List Mahasiswa Kelas ' . $kelas;
        $students = Student::where('class', $kelas)->get();
        $approval_krss = Krs::where('status', 1)->whereIn('student_id', $students->pluck('id'))->count();

        return view('krs.dosen', compact('title', 'students', 'kelas', 'approval_krss'));;
    }

    public function index_mahasiswa()
    {
        $title = 'List KRS Mahasiswa';
        $student = Auth::user()->student;
        $krss = Krs::where('student_id', $student->id)->get();
        return view('krs.krs_mahasiswa', compact('title', 'krss'));
    }

    public function approval_mahasiswa(Krs $krs)
    {
        $title = 'Persetujuan KRS Mahasiswa';
        return view('krs.mahasiswa', compact('krs', 'title'));
    }

    public function update_approval_mahasiswa(Request $request, Krs $krs)
    {
        $approves = $request->approves;
        foreach ($approves as $approve) {
            $krs_subject = KrsSubject::find($approve);
            $krs_subject->status = 1;
            $krs_subject->save();
        }
        $krs->status = 1;
        $krs->save();

        return redirect()->route('krs.index_mahasiswa')->with('message', 'KRS berhasil disetujui!');
    }

    public function update_approval_dosen(Krs $krs)
    {
        $krs->status = 2;
        $krs->save();

        return redirect()->back()->with('message', 'KRS berhasil diapprove oleh dosen!');
    }
}
