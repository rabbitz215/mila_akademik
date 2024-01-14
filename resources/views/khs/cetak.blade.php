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
	<title>Kartu Hasil Studi</title>
	<style>
		body {
			background-color: #fff;
		}

		#headerKrs hr {
			border: 1px solid black;
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
	<div id="absen">
		<div class="container">
			<div id="headerKrs">
				<div class="container">
					<div class="row mt-4">
						<div class="col-md-2 offset-md-1 mt-4">
							<img src="{{ asset('assets/img/logo.png') }}" alt="" width="" height="">
						</div>
						<div class="col-md-7 align-self-center text-center">
							<h5>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h5>
							<h5>POLITEKNIK NEGERI MALANG</h5>
							<small>Jalan Soekarno-Hatta No.9 Malang 65141</small><br>
							<small>Telepon (0341) 404424 - 404425 Fax (0341) 404420
							</small><br>
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
			<div class="row">
				<div class="col-12">
					<h4 class="text-center">KARTU HASIL STUDI (KHS)</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 offset-md-1">
					<table>
						<tr>
							<td width="40%">NAMA MAHASISWA</td>
							<td width="5%">:</td>
							<td>{{ $student->name }}</td>
						</tr>
						<tr>
							<td>NIM</td>
							<td>:</td>
							<td>{{ $student->nim }}</td>
						</tr>
						<tr>
							<td>TINGKAT/KELAS</td>
							<td>:</td>
							<td>{{ $student->class }}</td>
						</tr>
						<tr>
							<td>PROGRAM STUDI</td>
							<td>:</td>
							<td>{{ $student->study_program->name }}</td>
						</tr>
						<tr>
							<td>SEMESTER</td>
							<td>:</td>
							<td>{{ $khs->romanize_semester }}</td>
						</tr>
						<tr>
							<td>TAHUN AKADEMIK</td>
							<td>:</td>
							<td>@php
								$academicYear = \App\Setting::where('key', 'ACADEMIC_YEAR')->value('value');
								echo '20' . $academicYear - 1 . '/20' . $academicYear;
							@endphp</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-10 offset-md-1">
					<table class="tg table">
						<thead style="font-weight: bold;">
							<tr>
								<td class="tg-3xi5" rowspan="2" style="vertical-align: middle;">NO</td>
								<td class="tg-3xi5" rowspan="2" style="vertical-align: middle;">MATA KULIAH</td>
								<td class="tg-3xi5" colspan="2" style="vertical-align: middle; padding: 0;">NILAI</td>
								<td class="tg-3xi5" rowspan="2" style="vertical-align: middle;">J<span style="font-size: 10px;">m</span></td>
								<td class="tg-3xi5" rowspan="2" style="vertical-align: middle;">SKS</td>
								<td class="tg-3xi5" rowspan="2" style="vertical-align: middle;">N x SKS</td>
								<td class="tg-3xi5" rowspan="2" style="vertical-align: middle;">KETERANGAN</td>
							</tr>
							<tr>
								<td class="tg-3xi5" style="vertical-align: middle; padding: 0;">N<span style="font-size: 10px;">s</span></td>
								<td class="tg-3xi5" style="vertical-align: middle; padding: 0;">N<span style="font-size: 10px;">h</span></td>
							</tr>
						</thead>
						<tbody>
							@php
								$totalBobot = 0;
								$totalHour = 0;
							@endphp
							@foreach ($khs->khs_subjects as $index => $subject)
								<tr>
									<td class="tg-3xi5" style="height: 1px; padding: 0;">{{ $loop->iteration }}.</td>
									<td style="padding: 0;">{{ $subject->subject->name }}</td>
									<td class="tg-3xi5" style="padding: 0;">{{ number_format($subject->nilai, 2) }}</td>
									<td class="tg-3xi5" style="padding: 0;">{{ $subject->grade }}</td>
									<td class="tg-3xi5" style="padding: 0;">
										{{ $subject->subject->semester_subjects()->value('hour') }}
									</td>
									<td class="tg-3xi5" style="padding: 0;">
										{{ $subject->subject->sks }}
									</td>
									<td class="tg-3xi5" style="padding: 0;">
										@php
											$totalBobot += $subject->subject->sks * $subject->nilai;
											$totalHour += $subject->subject->semester_subjects()->value('hour');
										@endphp
										{{ $subject->subject->sks * $subject->nilai }}
									</td>
									@if ($loop->first)
										<td rowspan="13">
											<p>Ns: Nilai Setara Setiap Mata Kuliah<br>
												Nh: Nilai Huruf Setiap Mata Kuliah<br>
												SKS: Satuan Kredit Semester<br>
												IP: Indeks Prestasi Akhir Semester<br>
												k: Jumlah Mata Kuliah<br>
												A: Alpha<br>
												I: Izin<br>
												S: Sakit<br>
												L: Lulus<br>
												L**: Lulus Percobaan 3 Bulan<br>
												TRM: Terminal<br>
												PS: Putus Studi</p>
										</td>
									@endif
								</tr>
							@endforeach
							@for ($i = count($khs->khs_subjects) + 1; $i <= 12; $i++)
								<tr>
									<td class="tg-3xi5" style="height: 1px;"></td>
									<td class="tg-3xi5"></td>
									<td class="tg-3xi5"></td>
									<td class="tg-3xi5"></td>
									<td class="tg-3xi5"></td>
									<td class="tg-3xi5"></td>
									<td class="tg-3xi5"></td>
								</tr>
							@endfor
							<tr>
								<td colspan="4" style="font-weight: bold;">JUMLAH</td>
								<td class="tg-3xi5"><b>{{ $totalHour }}</b></td>
								<td class="tg-3xi5"><b>{{ $khs->total_sks }}</b></td>
								<td class="tg-3xi5"><b>{{ $totalBobot }}</b></td>
							</tr>
						</tbody>
					</table>
					<table class="tg table">
						<thead>
							<tr>
								<td colspan="3" style="vertical-align: middle; text-align: center;"><b>ABSEN</b></td>
								<td rowspan="4" class="" style="vertical-align: middle; font-size: 18px;">IP = <img
										src="https://latex.codecogs.com/svg.image?\frac{\sum_{m=1}^{k}N_{s}X&space;SKS}{\sum_{m=1}^{k}SKS}"
										title="\frac{\sum_{m=1}^{k}N_{s}X SKS}{\sum_{m=1}^{k}SKS}" /> =
									{{ number_format($khs->calculated_grade, 2) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status =
									{{ $khs->isLulus() ? 'L' : 'Tidak Lulus' }}</td>
							</tr>
							<tr>
								<td width="5%">A</td>
								<td width="5%">0:0</td>
								<td width="5%">Jam</td>
							</tr>
							<tr>
								<td>I</td>
								<td>0:0</td>
								<td>Jam</td>
							</tr>
							<tr>
								<td>S</td>
								<td>0:0</td>
								<td>Jam</td>
							</tr>
						</thead>
					</table>
					{{-- <table class="font-weight-bold">
						@if ($khs->previousKhs($khs->student_id) && $khs->previousKhs($khs->student_id)->count() > 0)
							<tr>
								<td>Indeks Prestasi Semester Sebelumnya</td>
								<td>:</td>
								<td>{{ number_format($khs->previousKhs($khs->student_id)->calculated_grade, 2) }}</td>
							</tr>
						@endif
						<tr>
							<td>Indeks Prestasi Semester</td>
							<td>:</td>
							<td>{{ number_format($khs->calculated_grade, 2) }}</td>
						</tr>
						<tr>
							<td>Status : {{ $khs->isLulus() ? 'Lulus' : 'Tidak Lulus' }}</td>
						</tr>
					</table> --}}
				</div>
			</div>
			<div class="ttd">
				<div class="container">
					<div class="row">
						<div class="col-md-5 offset-md-7">
							<table>
								<tr>
									<td>Malang, {{ \Carbon\Carbon::today()->format('d F Y') }}</td>
								</tr>
								<tr>
									<td>Ketua Jurusan Teknik Elektro</td>
								</tr>
								<tr>
									<td><br></td>
								</tr>
								<tr>
									<td><br></td>
								</tr>
								<tr>
									<td><br></td>
								</tr>
								<tr>
									<td><br></td>
								</tr>
								<tr>
									<td><b>Mochammad Junus, S.T., M.T.</b></td>
								</tr>
								<tr>
									<td><b>NIP. 197206191999031002</b></td>
								</tr>
							</table>
						</div>
					</div>
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
