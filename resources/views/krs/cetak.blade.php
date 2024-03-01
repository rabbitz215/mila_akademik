<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">

	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
	<title>Kartu Rencana Studi</title>
	<style>
		body {
			background-color: #fff;
		}

		#headerKrs hr {
			border: 1px solid black;
		}

		.krs {
			font-family: sans-serif;
			color: #232323;
			border-collapse: collapse;
		}

		.krs,
		.krs th,
		.krs td {
			border: 1px solid #999;
			padding: 3px 15px;
		}

		.jabatan {
			margin-top: -20px;
			font-size: 12px;
		}

		.col-md-2.photo {
			margin-right: -25px;
			margin-left: 35px;
		}

		@media print {
			body {
				margin: 0;
			}

			@page {
				size: letter;
			}
		}
	</style>
</head>

<body>
	<div id="headerKrs">
		<div class="container">
			<div class="row mt-4">
				<div class="col-md-2 offset-md-1 mt-4">
					<img src="{{ asset('assets/img/logo.png') }}" alt="" width="" height="">
				</div>
				<div class="col-md-7 align-self-center text-center">
					<p>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</p>
					<h4>POLITEKNIK NEGERI MALANG</h4>
					<small>Jalan Soekarno-Hatta No.9 Malang 65141</small>
					<small>Telepon (0341) 404424 - 404425 Fax (0341) 404420
					</small>
					<small>http://www.polinema.ac.id
					</small>
				</div>
				<div class="col-md-2 mt-4">
					<img src="{{ asset('assets/img/logo1.png') }}" alt="" width="" height="">
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<hr>
				</div>
				<div class="col-md-1">
				</div>
			</div>
		</div>
	</div>

	<div id="isiKrs">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h4 class="mb-5 mt-3">KARTU RENCANA STUDI (KRS)</h4>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10 offset-md-1">
					<table>
						<tr>
							<td width="50%">NIM</td>
							<td width="5%">:</td>
							<td>{{ $krs->student->nim }}</td>
						</tr>
						<tr>
							<td>NAMA</td>
							<td>:</td>
							<td>{{ $krs->student->name }}</td>
						</tr>
						<tr>
							<td>PROGRAM STUDI</td>
							<td>:</td>
							<td>{{ $krs->student->study_program->name }}</td>
						</tr>
						<tr>
							<td>KELAS</td>
							<td>:</td>
							<td>{{ $krs->student->class }}</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 offset-md-1">
					<table border="1" class="krs" style="width: 83%">
						<thead>
							<th style="text-align: center;">
								KODE MK
							</th>
							<th style="text-align: center;">
								MATA KULIAH
							</th>
							<th style="text-align: center;">
								SKS
							</th>
							<th style="text-align: center;">
								JAM
							</th>
						</thead>
						<tbody>
							@forelse ($krs->krs_subjects as $index => $item)
								<tr>
									<td style="text-align: center;">
										{{ $item->subject->kode_matkul }}
									</td>
									<td>
										{{ $item->subject->name }}
									</td>
									<td style="text-align: center;">
										{{ $item->subject->sks }}
									</td>
									<td style="text-align: center;">
										{{ $item->semester_subject->hour }}
									</td>
								</tr>
							@empty
								<tr>
									<td>
										Matakuliah tidak ada
									</td>
								</tr>
							@endforelse
							<tr>
								<td></td>
								<td style="text-align: center;"><b>JUMLAH</b></td>
								<td style="text-align: center;"><b>{{ $krs->total_sks }}</b></td>
								<td style="text-align: center;"><b>{{ $krs->total_jam }}</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-md-3 offset-md-1">
                    @if (auth()->user()->student)
                        @if (auth()->user()->student->krss()->where('semester', '<', $krs->semester)->count() > 0)
                        <p>IP Semester lalu : {{ number_format($krs->previousKrs()?->calculated_grade, 2) }}</p>
                        @endif
                        <p>IP Komulatif : {{ number_format($krs->calculated_all_grade, 2) }}</p>
                    @else
                        @if ($krs->student->krss()->where('semester', '<', $krs->semester)->count() > 0)
                        <p>IP Semester lalu : {{ number_format($krs->previousKrs()?->calculated_grade, 2) }}</p>
                        @endif
                        <p>IP Komulatif : {{ number_format($krs->calculated_all_grade, 2) }}</p>
                    @endif
				</div>
				<div class="col-md-3 text-center">
					{{-- <p>Menyetujui,</p>
					<br><br>
					<p class="font-weight-bold"><u></u></p>
					<p class="jabatan">Pembimbing Akademik</p> --}}
				</div>
				<div class="col-md-4 text-center">
					<p>Malang, {{ \Carbon\Carbon::today()->format('d F Y') }}</p>
					<p>Dosen Pembina Akademik ,</p>
					<br><br>
					@foreach ($krs->dosen_parent as $dosen)
						<p class="font-weight-bold"><u>{{ $dosen['name'] }}</u></p>
						<p class="jabatan">NIP. {{ $dosen['nip'] }}</p>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</body>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
	window.print()
</script>
</body>

</html>
