@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<a href="{{ route('study_programs.create') }}" class="btn btn-primary mb-3">Program Studi +</a>

	<table id="dataTable" class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($study_programs as $program)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $program->name }}</td>
					<td>
						<div class="d-flex">
							<a href="{{ route('study_programs.show', $program->id) }}" class="btn btn-sm btn-primary mr-2">Detail</a>
							<a href="{{ route('study_programs.edit', $program->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
							<form action="{{ route('study_programs.destroy', $program->id) }}" method="post">
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
