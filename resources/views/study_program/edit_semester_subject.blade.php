@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('study_programs.update_semester_subject', $semester_subject->id) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label for="name">Nama Mata Kuliah</label>
					<input type="hidden" name="study_program_id" value="{{ $semester_subject->study_program->id }}">
					<select name="subject_id" id="" class="form-control">
						@foreach ($semester_subject->study_program->subjects as $subject)
							<option value="{{ $subject->id }}" {{ $semester_subject->subject_id == $subject->id ? 'selected' : '' }}>
								{{ $subject->name }}</option>
						@endforeach
					</select>
					@error('subject_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="semester">Semester</label>
					<select name="semester" id="" class="form-control">
						@foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $semester)
							<option value="{{ $semester }}" {{ $semester == $semester_subject->semester ? 'selected' : '' }}>
								{{ $semester }}</option>
						@endforeach
					</select>
					@error('semester')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="hour">Jam</label>
					<input type="number" name="hour" value="{{ $semester_subject->hour }}" class="form-control">
					@error('hour')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('study_programs.show', $semester_subject->study_program->id) }}" class="btn btn-default">Back to
					Program Studi</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
