@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<a href="{{ route('dosens.create') }}" class="btn btn-primary mb-3">Dosen +</a>

	<table id="dataTable" class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>NIP</th>
				<th>Nama</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($dosens as $dosen)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $dosen->nip }}</td>
					<td>{{ $dosen->name }}</td>
					<td>
						<div class="d-flex">
							<a href="{{ route('dosens.edit', $dosen->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
							<form action="{{ route('dosens.destroy', $dosen->id) }}" method="post">
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
