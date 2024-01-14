@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	{{-- <a href="{{ route('kelass.create') }}" class="btn btn-primary mb-3">Kelas +</a> --}}

	<p>{{ $totalStudents }}</p>

	<table class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>Kelas</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($students as $student)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $student->nim }}</td>
					<td>{{ $student->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{-- {{ $students->links() }} --}}

	<!-- End of Main Content -->
@endsection
