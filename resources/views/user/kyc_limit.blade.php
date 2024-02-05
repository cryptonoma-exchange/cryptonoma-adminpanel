@php
$atitle ="kyclimit";
@endphp
@extends('layouts.header')
@section('content')
<section class="content">
	<div class="content__inner">
		<header class="content__title">
			<h1>Depoisit and withdraw limit setting</h1>
		</header>
		@if(session('status'))
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{ session('status') }}
		</div>
		@endif

		<div class="card">
			<div class="card-body"> 
				<form method="post" autocomplete="off" action="{{ url('admin/fiatlimitupdate') }}">
					{{ csrf_field() }}
					<div class="row">


						@foreach($kyc as $key => $value)
						<div class="col-md-3">
							<div class="form-group">
								<label>{{ ucwords($value->type) }} (CLP)</label>
							</div>
						</div>

						<div class="col-md-8">

							<div class="form-group">

								<input type="number" class="form-control" name="fiat_limit_{{ $value->type }}" step="0.01" min="0" max="10000000000000" value="{{ $value->fiat_limit }}" required="">

								<input type="hidden" name="type_{{ $value->type }}" value="{{ $value->type }}">
							</div>


						</div>
					@endforeach

						
					</div>
					<div class="form-group">
						<button type="submit" name="update_content" class="btn btn-light"><i class=""></i> Update Fiat</button>
					</div>
				</form>
			</div>
		</div>


			<div class="card">
			<div class="card-body"> 
				<form method="post" autocomplete="off" action="{{ url('admin/coinlimitupdate') }}">
					{{ csrf_field() }}
					<div class="row">


						@foreach($kyc as $key => $value)
						<div class="col-md-3">
							<div class="form-group">
								<label>{{ ucwords($value->type) }} (crypto)</label>
							</div>
						</div>

						<div class="col-md-8">

							<div class="form-group">

								<input type="number" class="form-control" name="crypto_limit_{{ $value->type }}" step="0.01" min="0" max="10000000000000"  value="{{ $value->crypto_limit }}" required="">
							
							</div>

						<input type="hidden" name="type_{{ $value->type }}" value="{{ $value->type }}">
						</div>
					@endforeach

						
					</div>
					<div class="form-group">
						<button type="submit" name="update_content" class="btn btn-light"><i class=""></i> Update Crypto</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endsection