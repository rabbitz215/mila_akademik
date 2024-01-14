@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

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
			@foreach ($khss as $khs)
				@php
					$student = $khs->student;
				@endphp
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $student->nim }}</td>
					<td>{{ $student->name }}</td>
					<td>{{ $student->class }}</td>
					<td>{{ $student->study_program->name }}</td>
					<td>{{ $khs->semester }}</td>
					<td>{{ $khs->status == 0 ? 'Belum Dinilai' : 'Sudah Dinilai' }}
						(IPK :
						{{ $khs->status == 1 ? number_format($khs->calculated_grade, 2) : '0' }}{{ $khs->khs_subjects->contains('grade', 'D') ? ', Tidak lulus, Total Nilai D : ' . $khs->khs_subjects->where('grade', 'D')->count() : '' }})
					</td>
					<td>
						<div class="d-flex">
							@if ($khs->status == 1)
								<a href="{{ route('khss.cetak', $khs->id) }}" class="btn btn-sm btn-primary mr-2">Cetak
								</a>
							@endif
							@role('admin')
								<a href="{{ route('khss.show', $khs->id) }}"
									class="btn btn-sm btn-primary mr-2">{{ $khs->status == 0 ? 'Tambah' : 'Edit' }} Nilai
								</a>
								<form action="{{ route('khss.destroy', $khs->id) }}" method="post">
									@csrf
									@method('delete')
									<button type="submit" class="btn btn-sm btn-danger"
										onclick="return confirm('Are you sure to delete this?')">Delete</button>
								</form>
							@endrole
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<!-- End of Main Content -->
@endsection
