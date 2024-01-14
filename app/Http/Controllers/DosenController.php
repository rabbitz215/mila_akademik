<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::get();
        $title = 'Dosen';

        return view('dosen.list', compact('dosens', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create', [
            'title' => 'Dosen Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dosen = new Dosen();
            $dosen->fill($request->except(['email', 'password', 'kelas']));
            $dosen->save();

            $user = new User();
            $user->fill($request->except(['nip', 'kelas']));
            $user->password = bcrypt($request->password);
            $user->save();

            $user->assignRole('dosen');

            $dosen->user_id = $user->id;
            $dosen->save();

            $dosen->kelas()->sync($request->input('kelas', []));

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollBack();
            dd($ex);
        }

        return redirect()->route('dosens.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', [
            'title' => 'Edit Dosen',
            'dosen' => $dosen,
            'user' => $dosen->user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dosen $dosen)
    {
        if ($request->filled('password')) {
            $dosen->user->password = Hash::make($request->password);
        }

        $dosen->nip = $request->nip;
        $dosen->name = $request->name;
        $dosen->save();

        $dosen->user->email = $request->email;
        $dosen->user->save();

        $dosen->kelas()->sync($request->input('kelas', []));

        return redirect()->route('dosens.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dosen $dosen)
    {
        $dosen->user()->delete();
        $dosen->kelas()->detach();
        $dosen->delete();

        return redirect()->route('dosens.index')->with('message', 'Dosen deleted successfully!');
    }
}
