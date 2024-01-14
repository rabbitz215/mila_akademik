@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('study_programs.store_semester_subject') }}" method="post">
				@csrf

				<div class="form-group">
					<label for="name">Nama Mata Kuliah</label>
					<input type="hidden" name="study_program_id" value="{{ $studyProgram->id }}">
					<select name="subject_id" id="" class="form-control">
						@foreach ($studyProgram->subjects as $subject)
							<option value="{{ $subject->id }}">{{ $subject->name }}</option>
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
							<option value="{{ $semester }}">{{ $semester }}</option>
						@endforeach
					</select>
					@error('semester')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="hour">Jam</label>
					<input type="number" name="hour" class="form-control">
					@error('hour')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('study_programs.show', $studyProgram->id) }}" class="btn btn-default">Back to Program Studi</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
