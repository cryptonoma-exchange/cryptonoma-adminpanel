@extends('layouts.header')
@section('title', 'Add Coin pair Settings')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Add Trade pair</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/tradepairlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Trade pairs</a>
						<br /><br />
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
							</div>
						@endif

						@if (session('error'))
							<div class="alert alert-danger" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Error!</strong> {{ session('error') }}
							</div>
						@endif

						<form method="post" action="{{ url('admin/addpairinsert') }}" autocomplete="off">
							{{ csrf_field() }}

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Coin One</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select name="coinone" class="form-control">
											<option value="">Select Coin/Currency</option>
											@foreach ($pairres as $value)
												<option value="{{ $value->source }}">{{ $value->source }}</option>
											@endforeach
										</select>
										@if ($errors->has('coinone'))
											<span class="help-block">
												<strong>{{ $errors->first('coinone') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Coin Two</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<select name="cointwo" class="form-control">
											<option value="">Select Coin/Currency</option>
											@foreach ($pairres as $value)
												<option value="{{ $value->source }}">{{ $value->source }}</option>
											@endforeach
										</select>
										@if ($errors->has('cointwo'))
											<span class="help-block">
												<strong>{{ $errors->first('cointwo') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i>Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection
