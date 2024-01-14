@extends('layouts.admin')

@section('main-content')
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

	<!-- Main Content goes here -->

	<div class="card">
		<div class="card-body">
			<form action="{{ route('settings.update', $tahun_ajaran->id) }}" method="post">
				@csrf
				@method('put')

				<div class="form-group">
					<label for="tahun_ajaran">Tahun Ajaran</label>
					<select class="form-control @error('value') is-invalid @enderror" name="value">
						<option value="30" {{ $tahun_ajaran->value == '30' ? 'selected' : '' }}>2029/2030</option>
						<option value="29" {{ $tahun_ajaran->value == '29' ? 'selected' : '' }}>2028/2029</option>
						<option value="28" {{ $tahun_ajaran->value == '28' ? 'selected' : '' }}>2027/2028</option>
						<option value="27" {{ $tahun_ajaran->value == '27' ? 'selected' : '' }}>2026/2027</option>
						<option value="26" {{ $tahun_ajaran->value == '26' ? 'selected' : '' }}>2025/2026</option>
						<option value="25" {{ $tahun_ajaran->value == '25' ? 'selected' : '' }}>2024/2025</option>
						<option value="24" {{ $tahun_ajaran->value == '24' ? 'selected' : '' }}>2023/2024</option>
						<option value="23" {{ $tahun_ajaran->value == '23' ? 'selected' : '' }}>2022/2023</option>
						<option value="22" {{ $tahun_ajaran->value == '22' ? 'selected' : '' }}>2021/2022</option>
						<option value="21" {{ $tahun_ajaran->value == '21' ? 'selected' : '' }}>2020/2021</option>
						<option value="20" {{ $tahun_ajaran->value == '20' ? 'selected' : '' }}>2019/2020</option>
						<option value="19" {{ $tahun_ajaran->value == '19' ? 'selected' : '' }}>2018/2019</option>
						<option value="18" {{ $tahun_ajaran->value == '18' ? 'selected' : '' }}>2017/2018</option>
						<option value="17" {{ $tahun_ajaran->value == '17' ? 'selected' : '' }}>2016/2017</option>
						<option value="16" {{ $tahun_ajaran->value == '16' ? 'selected' : '' }}>2015/2016</option>
						<option value="15" {{ $tahun_ajaran->value == '15' ? 'selected' : '' }}>2014/2015</option>
						<option value="14" {{ $tahun_ajaran->value == '14' ? 'selected' : '' }}>2013/2014</option>
						<option value="13" {{ $tahun_ajaran->value == '13' ? 'selected' : '' }}>2012/2013</option>
						<option value="12" {{ $tahun_ajaran->value == '12' ? 'selected' : '' }}>2011/2012</option>
						<option value="11" {{ $tahun_ajaran->value == '11' ? 'selected' : '' }}>2010/2011</option>
						<option value="10" {{ $tahun_ajaran->value == '10' ? 'selected' : '' }}>2009/2010</option>
					</select>
					@error('value')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>

	<!-- End of Main Content -->
@endsection
