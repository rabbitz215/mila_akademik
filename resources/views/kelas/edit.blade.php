@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('kelass.update', $kelas->id) }}" method="post">
				@csrf
				@method('put')

				<div class="form-group">
					<label for="tingkat">Tingkat</label>
					<select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
						<option value="1" {{ $kelas->tingkat == 1 ? 'selected' : '' }}>1</option>
						<option value="2" {{ $kelas->tingkat == 2 ? 'selected' : '' }}>2</option>
						<option value="3" {{ $kelas->tingkat == 3 ? 'selected' : '' }}>3</option>
						<option value="4" {{ $kelas->tingkat == 4 ? 'selected' : '' }}>4</option>
					</select>
					@error('tingkat')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="kelas">Kelas (A,B,C,D,...)</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="kelas" id="kelas"
						placeholder="Kelas" autocomplete="off" value="{{ old('kelas') ?? $kelas->kelas }}">
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
