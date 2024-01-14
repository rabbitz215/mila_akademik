<?php

namespace App\Http\Controllers;

use App\Khs;
use Illuminate\Http\Request;

class KhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khss = Khs::get();
        if (auth()->user()->hasRole('mahasiswa')) {
            $khss = Khs::where('student_id', auth()->user()->student->id)->get();
        }
        $title = auth()->user()->role == 'mahasiswa' ? 'KHS ' . auth()->user()->student->name : 'List KHS Mahasiswa';
        return view('khs.list', compact('title', 'khss'));
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
    public function show($khs)
    {
        if (auth()->user()->role == 'dosen' || auth()->user()->role == 'mahasiswa') {
            abort(403);
        }
        $khs = Khs::find($khs);
        $student = $khs->student;
        return view('khs.show', compact('khs', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Khs $khs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $khs)
    {
        if (auth()->user()->role == 'dosen') {
            abort(403);
        }
        $khs = Khs::find($khs);

        foreach ($khs->khs_subjects as $khsSubject) {
            $subjectId = $khsSubject->id;

            // Check if the grade for this subject is present in the request
            if ($request->has("grades.$subjectId")) {
                $grade = $request->input("grades.$subjectId");

                // Update the grade for the current khs_subject
                $khsSubject->update(['grade' => $grade]);
            }
        }

        $khs->status = 1;
        $khs->save();

        return redirect()->route('khss.index')->with('message', 'KHS berhasil ditambah nilai!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Khs $khs)
    {
        //
    }

    public function cetak($khs)
    {
        $khs = Khs::find($khs);
        $student = $khs->student;

        return view('khs.cetak', compact('khs', 'student'));
    }
}
