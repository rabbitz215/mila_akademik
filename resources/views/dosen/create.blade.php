@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('dosens.store') }}" method="post">
				@csrf

				<div class="form-group">
					<label for="nip">NIP</label>
					<input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip"
						placeholder="nip" autocomplete="off" value="{{ old('nip') }}">
					@error('nip')
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
						placeholder="Password" autocomplete="off" value="{{ old('password') }}">
					@error('password')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="name">Kelas</label>
					<div class="row">
						@foreach (\App\Kelas::get() as $kelas)
							<div class="col-2"> <!-- Each column takes up 2 units in a 12-unit grid, creating a grid of 6 columns -->
								<div class="form-check mb-2">
									<input type="checkbox" name="kelas[]" id="kelas_{{ $kelas->id }}" class="form-check-input"
										value="{{ $kelas->id }}">
									<label class="form-check-label" for="kelas_{{ $kelas->id }}">
										{{ $kelas->tingkat . $kelas->kelas }}
									</label>
								</div>
							</div>
						@endforeach
					</div>
					@error('kelas')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('dosens.index') }}" class="btn btn-default">Back to list</a>

			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
