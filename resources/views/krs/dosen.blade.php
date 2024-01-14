@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary h-100 py-2 shadow">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Siswa Kelas {{ $kelas }}</div>
							<div class="h5 font-weight-bold mb-0 text-gray-800">
								{{ $students->count() }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary h-100 py-2 shadow">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Siswa Laki-Laki Kelas
								{{ $kelas }}</div>
							<div class="h5 font-weight-bold mb-0 text-gray-800">
								{{ $students->where('gender', 'Laki-Laki')->count() }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary h-100 py-2 shadow">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Siswa Perempuan Kelas
								{{ $kelas }}</div>
							<div class="h5 font-weight-bold mb-0 text-gray-800">
								{{ $students->where('gender', 'Perempuan')->count() }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary h-100 py-2 shadow">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total KRS Siswa Butuh Approval Kelas
								{{ $kelas }}</div>
							<div class="h5 font-weight-bold mb-0 text-gray-800">
								{{ $approval_krss }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
					<td>{{ $student->study_program->name }}</td>
					<td>
						<div class="d-flex">
							@role('admin')
								<a href="#" class="btn btn-sm btn-primary krs-btn mr-2" data-id="{{ $student->id }}">Buat KRS</a>
								<a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
								<form action="{{ route('students.destroy', $student->id) }}" method="post">
									@csrf
									@method('delete')
									<button type="submit" class="btn btn-sm btn-danger"
										onclick="return confirm('Are you sure to delete this?')">Delete</button>
								</form>
							@endrole
							@role('dosen')
								@if ($student->krss()->latest()->first())
									@if ($student->krss()->latest()->first()->status == 2)
										<button class="btn btn-sm btn-success disabled ml-2" style="cursor:default;">Sudah di approve</button>
									@elseif ($student->krss()->latest()->first()->status == 1)
										<form action="{{ route('krs.update_approval_dosen',$student->krss()->latest()->first('id')) }}" method="post">
											@csrf
											@method('put')
											<button type="submit" class="btn btn-sm btn-primary ml-2"
												onclick="return confirm('Apakah anda yakin?')">Approve & Siap Cetak
												KRS</button>
										</form>
									@endif
								@else
									<button class="btn btn-sm btn-primary disabled ml-2">Approve & Siap Cetak
										KRS</button>
								@endif
							@endrole
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
					<h5 class="modal-title" id="krsModalLabel">Buat KRS</h5>
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
