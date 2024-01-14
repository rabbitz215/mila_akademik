<?php

namespace App\Http\Controllers;

use App\SemesterSubject;
use Illuminate\Http\Request;

class SemesterSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Mata Kuliah Prodi';
        return view('semester_subject.create', compact('title'));
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
    public function show(SemesterSubject $semesterSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SemesterSubject $semesterSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SemesterSubject $semesterSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SemesterSubject $semesterSubject)
    {
        //
    }
}
