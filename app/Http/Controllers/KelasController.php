<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelass = Kelas::orderBy('tingkat')->get();
        $title = 'Kelas';

        return view('kelas.list', compact('kelass', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create', [
            'title' => 'Kelas Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $kelas = new Kelas();
            $kelas->fill($request->except([]));
            $kelas->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollBack();
        }

        return redirect()->route('kelass.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($kelas)
    {
        $kelas = Kelas::find($kelas);

        $students = Student::where('class', $kelas->tingkat . $kelas->kelas)->get();

        $totalStudents = $students->count();

        return view('kelas.show', compact('students', 'kelas', 'totalStudents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kelas)
    {
        $kelas = Kelas::find($kelas);
        return view('kelas.edit', [
            'title' => 'Edit Kelas',
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kelas)
    {
        $kelas = Kelas::find($kelas);
        $kelas->fill($request->except([]));
        $kelas->save();

        return redirect()->route('kelass.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kelas)
    {
        $kelas = Kelas::find($kelas);
        $kelas->delete();

        return redirect()->route('kelass.index')->with('message', 'Kelas deleted successfully');
    }
}
