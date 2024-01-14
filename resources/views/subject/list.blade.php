@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Mata Kuliah +</a>

	<table id="dataTable" class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>SKS</th>
				<th>Prodi</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($subjects as $subject)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $subject->name }}</td>
					<td>{{ $subject->sks }}</td>
					<td>{{ $subject->study_program->name }}</td>
					<td>
						<div class="d-flex">
							<a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
							<form action="{{ route('subjects.destroy', $subject->id) }}" method="post">
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

	<!-- End of Main Content -->
@endsection
