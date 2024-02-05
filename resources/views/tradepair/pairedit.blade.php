@extends('layouts.header')
@section('title', 'Tradepair Settings')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Trade pair Settings</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/tradepairlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Trade Pairs</a>
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
						<form method="post" action="{{ url('admin/pairupdate/'.$pairres->id) }}" autocomplete="off">
							{{ csrf_field() }}

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Coin One</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select name="coinone" class="form-control" disabled readonly>

											@foreach ($commission as $value)
												<option value="{{ $value->source }}" <?php if ($pairres->coinone == $value->source) {
												    echo 'selected';
												} ?>>{{ $value->source }}</option>
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

										<select name="cointwo" class="form-control" disabled readonly>
											@foreach ($commission as $value)
												<option value="{{ $value->source }}" <?php if ($pairres->cointwo == $value->source) {
												    echo 'selected';
												} ?>>{{ $value->source }}</option>
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

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Active Status</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<select name="activestatus" class="form-control">
											<option value="1" <?php if ($pairres->active == 1) {
											    echo 'selected';
											} ?>>Active</option>
											<option value="0" <?php if ($pairres->active == 0) {
											    echo 'selected';
											} ?>>Deactive</option>
										</select>
										@if ($errors->has('activestatus'))
											<span class="help-block">
												<strong>{{ $errors->first('activestatus') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection
