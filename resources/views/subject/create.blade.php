@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('subjects.store') }}" method="post">
				@csrf

				<div class="form-group">
					<label for="name">Kode Matkul</label>
					<input type="text" class="form-control @error('kode_matkul') is-invalid @enderror" name="kode_matkul"
						id="kode_matkul" placeholder="Kode Matkul" autocomplete="off" value="{{ old('kode_matkul') }}">
					@error('kode_matkul')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="name">Nama</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
						placeholder="name" autocomplete="off" value="{{ old('name') }}">
					@error('name')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="sks">SKS</label>
					<input type="number" min="1" class="form-control @error('sks') is-invalid @enderror" name="sks"
						id="sks" placeholder="sks" autocomplete="off" value="{{ old('sks') }}">
					@error('sks')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="study_program_id">Program Studi</label>
					<select name="study_program_id" class="form-control @error('study_program_id') is-invalid @enderror">
						@foreach (\App\StudyProgram::get() as $program)
							<option value="{{ $program->id }}">{{ $program->name }}</option>
						@endforeach
					</select>
					@error('study_program_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('subjects.index') }}" class="btn btn-default">Back to list</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
