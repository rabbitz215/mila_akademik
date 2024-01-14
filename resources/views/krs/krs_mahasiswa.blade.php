@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	{{-- <a href="{{ route('krss.create') }}" class="btn btn-primary mb-3">KRS +</a> --}}

	<table id="dataTable" class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Program Studi</th>
				<th>Semester</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($krss as $krs)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $krs->student->nim }}</td>
					<td>{{ $krs->student->name }}</td>
					<td>{{ $krs->student->class ?: '-' }}</td>
					<td>{{ $krs->student->study_program->name }}</td>
					<td>{{ $krs->semester }}</td>
					<td>{{ $krs->status_label == 'Butuh Approval' ? 'Butuh Approval Dosen' : $krs->status_label }}</td>
					<td>
						<div class="d-flex">
							@if ($krs->status == \App\Krs::NEW_KRS)
								<a href="{{ route('krs.approval_mahasiswa', $krs->id) }}" class="btn btn-sm btn-primary mr-2">Check Persetujuan
									KRS</a>
							@endif
							@if ($krs->status == \App\Krs::APPROVED_KRS)
								<a href="{{ route('krs.cetak', $krs->id) }}" class="btn btn-sm btn-primary mr-2">Cetak</a>
							@endif
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<!-- End of Main Content -->
@endsection
