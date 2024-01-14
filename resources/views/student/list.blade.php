@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Mahasiswa +</a>
	<a href="{{ route('students.acak') }}" class="btn btn-primary mb-3">Acak Kelas</a>

	<table id="dataTable" class="table-bordered table-stripped table">
		<thead>
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Program Studi</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($students as $student)
				<tr>
					<td scope="row">{{ $loop->iteration }}</td>
					<td>{{ $student->nim }}</td>
					<td>{{ $student->name }}</td>
					<td>{{ $student->class ?: '-' }}</td>
					<td>{{ $student->study_program ? $student->study_program->name : '-' }}</td>
					<td>
						<div class="d-flex">
							@role('admin')
								@if (!$student->class == null)
									<a href="#" class="btn btn-sm btn-primary krs-btn mr-2" data-id="{{ $student->id }}">Buat KRS</a>
									@if ($student->krss->count() > 0)
										<a href="#" class="btn btn-sm btn-primary khs-btn mr-2" data-id="{{ $student->id }}"
											data-options='@json($student->krss->where('status', 2)->pluck('semester')->toArray())'>Buat
											KHS</a>
									@endif
								@endif
							@endrole
							<a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
							<form action="{{ route('students.destroy', $student->id) }}" method="post">
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

	<div class="modal fade" id="krsModal" tabindex="-1" role="dialog" aria-labelledby="krsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="krsModalLabel">Buat KRS (Kartu Rencana Studi)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="krsModalForm" action="" method="post">
						@csrf
						<!-- Add a select dropdown for selecting semesters -->
						<div class="form-group">
							<label for="semester">Semester</label>
							<select class="form-control" id="semester" name="semester">
								@for ($i = 1; $i <= 8; $i++)
									<option value="{{ $i }}">Semester {{ $i }}</option>
								@endfor
							</select>
						</div>

						<button type="submit" class="btn btn-primary">Buat</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="khsModal" tabindex="-1" role="dialog" aria-labelledby="khsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="khsModalLabel">Buat KHS (Kartu Hasil Ujian)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="khsModalForm" action="" method="post">
						@csrf
						<!-- Add a select dropdown for selecting semesters -->
						<div class="form-group">
							<label for="semester">Semester</label>
							<select id="selectSemester" class="form-control" name="semester">
								<!-- Options will be populated here -->
							</select>
						</div>

						<button type="submit" class="btn btn-primary">Buat</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			// Add a click event handler for the 'Edit' button
			$('.krs-btn').on('click', function(e) {
				e.preventDefault();

				// Get the student ID from the data-id attribute
				var studentId = $(this).data('id');

				// Set the student ID in the modal form action
				$('#krsModalForm').attr('action', "{{ route('students.make_krs', '') }}/" + studentId);

				// Show the modal
				$('#krsModal').modal('show');
			});

			$('.khs-btn').on('click', function(e) {
				e.preventDefault();

				// Get the student ID from the data-id attribute
				var studentId = $(this).data('id');
				var options = $(this).data('options');

				populateSelectOptions(options);

				// Set the student ID in the modal form action
				$('#khsModalForm').attr('action', "{{ route('students.make_khs', '') }}/" + studentId);

				// Show the modal
				$('#khsModal').modal('show');
			});

			function populateSelectOptions(options) {
				var selectSemester = $('#selectSemester');
				selectSemester.empty(); // Clear previous options
				$.each(options, function(index, semester) {
					selectSemester.append('<option value="' + semester + '">Semester ' + semester +
						'</option>');
				});
			}
		});
	</script>
	<!-- End of Main Content -->
@endsection

@push('notif')
	@if (session('success'))
		<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
			{{ session('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if (session('warning'))
		<div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
			{{ session('warning') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if (session('error'))
		<div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
			{{ session('error') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if (session('status'))
		<div class="alert alert-success border-left-success" role="alert">
			{{ session('status') }}
		</div>
	@endif
@endpush
