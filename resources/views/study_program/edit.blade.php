@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('study_programs.update', $study_program->id) }}" method="post">
				@csrf
				@method('put')

				<div class="form-group">
					<label for="name">name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
						placeholder="name" autocomplete="off" value="{{ old('name') ?? $study_program->name }}">
					@error('name')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('study_programs.index') }}" class="btn btn-default">Back to list</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
