@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">KHS Mahasiswa</h1>

	<!-- Main Content goes here -->

	{{-- <a href="{{ route('kelass.create') }}" class="btn btn-primary mb-3">Kelas +</a> --}}

	<p>{{ $khs->status == 0 ? 'Tambah' : 'Edit' }} Nilai Untuk KHS {{ $student->name }} Semester {{ $khs->semester }}</p>

	<form action="{{ route('khss.update', $khs->id) }}" method="POST">
		@csrf
		@method('PUT')

		<table class="table-bordered table-stripped table">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Matkul</th>
					<th>Nama Matkul</th>
					<th>SKS</th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($khs->khs_subjects as $subject)
					<tr>
						<td scope="row">{{ $loop->iteration }}</td>
						<td>{{ $subject->subject->kode_matkul }}</td>
						<td>{{ $subject->subject->name }}</td>
						<td>{{ $subject->subject->sks }}</td>
						<td>
							<div class="form-check form-check-inline">
								<input type="radio" name="grades[{{ $subject->id }}]" id="grade_A_{{ $subject->id }}" value="A"
									{{ $subject->grade === 'A' ? 'checked' : '' }}>
								<label class="form-check-label" for="grade_A_{{ $subject->id }}">A</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" name="grades[{{ $subject->id }}]" id="grade_Bplus_{{ $subject->id }}" value="B+"
									{{ $subject->grade === 'B+' ? 'checked' : '' }}>
								<label class="form-check-label" for="grade_Bplus_{{ $subject->id }}">B+</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" name="grades[{{ $subject->id }}]" id="grade_B_{{ $subject->id }}" value="B"
									{{ $subject->grade === 'B' ? 'checked' : '' }}>
								<label class="form-check-label" for="grade_B_{{ $subject->id }}">B</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" name="grades[{{ $subject->id }}]" id="grade_Cplus_{{ $subject->id }}" value="C+"
									{{ $subject->grade === 'C+' ? 'checked' : '' }}>
								<label class="form-check-label" for="grade_Cplus_{{ $subject->id }}">C+</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" name="grades[{{ $subject->id }}]" id="grade_D_{{ $subject->id }}" value="D"
									{{ $subject->grade === 'D' ? 'checked' : '' }}>
								<label class="form-check-label" for="grade_D_{{ $subject->id }}">D</label>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<button type="submit" class="btn btn-primary">Simpan</button>
	</form>

	{{-- {{ $students->links() }} --}}

	<!-- End of Main Content -->
@endsection
