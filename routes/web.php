<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\SemesterSubjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\SubjectController;
use App\Krs;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::middleware('auth')->group(function () {
    Route::resource('basic', BasicController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('students', StudentController::class);
    Route::post('students/make_krs/{student}', [StudentController::class, 'make_krs'])->name('students.make_krs');
    Route::post('students/make_khs/{student}', [StudentController::class, 'make_khs'])->name('students.make_khs');
    Route::get('acak-kelas', [StudentController::class, 'acak_kelas'])->name('students.acak');
    Route::resource('dosens', DosenController::class);
    Route::resource('kelass', KelasController::class);

    Route::resource('study_programs', StudyProgramController::class);
    Route::get('study_programs/semester_subject/{study_program}', [StudyProgramController::class, 'create_semester_subject'])->name('study_programs.create_semester_subject');
    Route::get('study_programs/semester_subject/{semester_subject}/edit', [StudyProgramController::class, 'edit_semester_subject'])->name('study_programs.edit_semester_subject');
    Route::post('study_programs/semester_subject', [StudyProgramController::class, 'store_semester_subject'])->name('study_programs.store_semester_subject');
    Route::put('study_programs/semester_subject/{semester_subject}', [StudyProgramController::class, 'update_semester_subject'])->name('study_programs.update_semester_subject');
    Route::delete('study_programs/semester_subject/{semester_subject}', [StudyProgramController::class, 'destroy_semester_subject'])->name('study_programs.destroy_semester_subject');

    Route::resource('subjects', SubjectController::class);

    Route::resource('krss', KrsController::class);

    Route::resource('settings', SettingController::class);
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('krs/{kelas}', [KrsController::class, 'dosen'])->name('krs.dosen');
    Route::put('krs_approval/{krs}', [KrsController::class, 'update_approval_dosen'])->name('krs.update_approval_dosen');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('krs_index', [KrsController::class, 'index_mahasiswa'])->name('krs.index_mahasiswa');
    Route::get('approval_krs/{krs?}', [KrsController::class, 'approval_mahasiswa'])->name('krs.approval_mahasiswa');
    Route::put('approval_krs/{krs}', [KrsController::class, 'update_approval_mahasiswa'])->name('krs.update_approval_mahasiswa');
});

Route::middleware('auth')->group(function () {
    Route::get('krs_cetak/{krs}', function ($krs) {
        $krs = Krs::find($krs);
        return view('krs.cetak', compact('krs'));
    })->name('krs.cetak');
    Route::resource('khss', KhsController::class);


    Route::get('/khss/cetak/{khs}', [KhsController::class, 'cetak'])->name('khss.cetak');
});
