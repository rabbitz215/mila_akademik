@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('students.store') }}" method="post">
				@csrf

				<div class="form-group">
					<label for="nim">NIM</label>
					<input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
						placeholder="NIM" autocomplete="off" value="{{ old('nim') }}">
					@error('nim')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="name">Nama</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
						placeholder="Last name" autocomplete="off" value="{{ old('name') }}">
					@error('name')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="name">Program Studi</label>
					<select name="study_program_id" id="" class="form-control">
						@foreach (\App\StudyProgram::get() as $study_program)
							<option value="{{ $study_program->id }}">{{ $study_program->name }}</option>
						@endforeach
					</select>
					@error('study_program_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
						placeholder="Email" autocomplete="off" value="{{ old('email') }}">
					@error('email')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
						placeholder="Password" autocomplete="off">
					@error('password')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('students.index') }}" class="btn btn-default">Back to list</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
