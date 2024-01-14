@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<a href="{{ route('kelass.create') }}" class="btn btn-primary mb-3">Kelas +</a>

	<table id="dataTable" class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>Kelas</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($kelass as $kelas)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $kelas->tingkat . $kelas->kelas }}</td>
					<td>
						<div class="d-flex">
							<a href="{{ route('kelass.show', $kelas->id) }}" class="btn btn-sm btn-primary mr-2">Show</a>
							<a href="{{ route('kelass.edit', $kelas->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
							<form action="{{ route('kelass.destroy', $kelas->id) }}" method="post">
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
