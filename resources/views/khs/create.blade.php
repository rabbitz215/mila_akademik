@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('kelass.store') }}" method="post">
				@csrf

				<div class="form-group">
					<label for="tingkat">Tingkat</label>
					<select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
					@error('tingkat')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="kelas">Kelas (A,B,C,D,...)</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="kelas" id="kelas"
						placeholder="Kelas" autocomplete="off" value="{{ old('kelas') }}">
					@error('kelas')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('kelass.index') }}" class="btn btn-default">Back to list</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
