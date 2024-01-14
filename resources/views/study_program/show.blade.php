@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	{{-- <a href="{{ route('kelass.create') }}" class="btn btn-primary mb-3">Kelas +</a> --}}

	<div class="">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group focused">
					<label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
					<input disabled type="text" id="name" class="form-control" name="name" placeholder="Name"
						value="{{ $studyProgram->name }}">
				</div>
			</div>
			{{-- <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label" for="last_name">Last name</label>
                    <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name" value="{{ old('last_name', Auth::user()->last_name) }}">
                </div>
            </div> --}}
		</div>
	</div>

	<a href="{{ route('study_programs.create_semester_subject', $studyProgram->id) }}" class="btn btn-primary mb-3">Mata
		Kuliah +</a>

	<table class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>Mata Kuliah</th>
				<th>Semester</th>
				<th>SKS</th>
				<th>Jam</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($studyProgram->semester_subjects as $subject)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $subject->subject->name }}</td>
					<td>{{ $subject->semester }}</td>
					<td>{{ $subject->subject->sks }}</td>
					<td>{{ $subject->hour ?: '-' }}</td>
					<td>
						<div class="d-flex">
							<a href="{{ route('study_programs.edit_semester_subject', $subject->id) }}"
								class="btn btn-sm btn-primary mr-2">Edit</a>
							<form action="{{ route('study_programs.destroy_semester_subject', $subject->id) }}" method="post">
								@csrf
								@method('delete')
								<button type="submit" class="btn btn-sm btn-danger"
									onclick="return confirm('Are you sure to delete this?')">Delete</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{-- {{ $students->links() }} --}}

	<!-- End of Main Content -->
@endsection
