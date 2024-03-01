@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="row">
    @role('admin')
    <!-- <div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary h-100 py-2 shadow">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Earnings (Monthly)</div>
								<div class="h5 font-weight-bold mb-0 text-gray-800">$40,000</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-calendar fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div> -->
    @endrole

    @role('mahasiswa')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2 shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Kelas</div>
                        <div class="h5 font-weight-bold mb-0 text-gray-800">{{ auth()->user()->student->class }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2 shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total KRS</div>
                        <div class="h5 font-weight-bold mb-0 text-gray-800">
                            {{ \App\Krs::where('student_id', auth()->user()->student->id)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2 shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total KHS</div>
                        <div class="h5 font-weight-bold mb-0 text-gray-800">
                            {{ \App\Khs::where('student_id', auth()->user()->student->id)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('dosen')
    @php
    $dosen = auth()->user()->dosen;
    $dosenClassStrings = $dosen->kelas->map(function ($kelas) {
    return $kelas->tingkat . $kelas->kelas;
    });
    $student_groups = \App\Student::whereIn('class', $dosenClassStrings)
    ->get()
    ->groupBy('class');
    $totalStudents = $student_groups
    ->map(function ($students) {
    return $students->count();
    })
    ->sum();
    $totalStudentsMale = $student_groups
    ->map(function ($students) {
    return $students->where('gender', 'Laki-Laki')->count();
    })
    ->sum();
    $totalStudentsFemale = $student_groups
    ->map(function ($students) {
    return $students->where('gender', 'Perempuan')->count();
    })
    ->sum();
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2 shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Siswa Semua Kelas Anda</div>
                        <div class="h5 font-weight-bold mb-0 text-gray-800">
                            {{ $totalStudents }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2 shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Siswa Laki-Laki Semua Kelas Anda
                        </div>
                        <div class="h5 font-weight-bold mb-0 text-gray-800">
                            {{ $totalStudentsMale }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2 shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Siswa Perempuan Semua Kelas Anda
                        </div>
                        <div class="h5 font-weight-bold mb-0 text-gray-800">
                            {{ $totalStudentsFemale }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
</div>
@endsection