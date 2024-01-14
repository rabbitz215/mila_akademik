@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	{{-- <a href="{{ route('krss.create') }}" class="btn btn-primary mb-3">KRS +</a> --}}

	<form action="{{ route('krs.update_approval_mahasiswa', $krs->id) }}" method="post">
		@csrf
		@method('PUT')
		<table class="table-bordered table-stripped table">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Matkul</th>
					<th>Nama Matkul</th>
					<th>SKS</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($krs->krs_subjects as $subject)
					<tr>
						<td scope="row">{{ $loop->iteration }}</td>
						<td>{{ $subject->subject->kode_matkul }}</td>
						<td>{{ $subject->subject->name }}</td>
						<td>{{ $subject->subject->sks }}</td>
						<td>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" name="approves[]" value="{{ $subject->id }}"
									id="approveCheckbox{{ $loop->iteration }}">
								<label class="form-check-label" for="approveCheckbox{{ $loop->iteration }}">Setuju</label>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<button type="submit" id="submitBtn" class="btn btn-primary" disabled>Submit</button>
	</form>

	<!-- End of Main Content -->
	<script>
		const checkboxes = document.querySelectorAll('input[name="approves[]"]');
		const submitButton = document.getElementById('submitBtn');

		checkboxes.forEach((checkbox) => {
			checkbox.addEventListener('change', () => {
				const allChecked = [...checkboxes].every((checkbox) => checkbox.checked);
				submitButton.disabled = !allChecked;
			});
		});
	</script>
@endsection
