@php
$atitle ="referral";
@endphp
@extends('layouts.header')
@section('title', 'Home banner')
@section('content')
<section class="content">
	<div class="content__inner">
		<header class="content__title">
			<h1>Update Referral Settings</h1>
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
				<form method="post" autocomplete="off" action="{{ url('admin/save_referral') }}">
					{{ csrf_field() }}


		<h5><b>Trading Fee Rewards :</b></h5>
<br>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label> Level 1(%)</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="level1" value="{{$terms->level1}}" >
</div>
	@if ($errors->has('level1'))
								<span class="help-block">
									<strong>{{ $errors->first('level1') }}</strong>
								</span>
								@endif
</div>
</div>


<div class="row">
<div class="col-md-3">
<div class="form-group">
<label> Level 2(%)</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="level2" value="{{$terms->level2}}" >
</div>
	@if ($errors->has('level2'))
								<span class="help-block">
									<strong>{{ $errors->first('level2') }}</strong>
								</span>
								@endif
</div>
</div>


<div class="row">
<div class="col-md-3">
<div class="form-group">
<label> Level 3(%)</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="level3" value="{{$terms->level3}}" >
</div>
	@if ($errors->has('level2'))
								<span class="help-block">
									<strong>{{ $errors->first('level2') }}</strong>
								</span>
								@endif
</div>
</div>

<h5><b>Referral Bonus :</b></h5>
<br>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label> Level 1</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="bonuslevel1" value="{{$terms->bonuslevel1}}" >
</div>
@if ($errors->has('bonuslevel1'))
								<span class="help-block">
									<strong>{{ $errors->first('bonuslevel1') }}</strong>
								</span>
								@endif
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>  Level 2</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="bonuslevel2" value="{{$terms->bonuslevel2}}" >
</div>
@if ($errors->has('bonuslevel2'))
								<span class="help-block">
									<strong>{{ $errors->first('bonuslevel2') }}</strong>
								</span>
								@endif
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>  Level 3</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="bonuslevel3" value="{{$terms->bonuslevel3}}" >
</div>
@if ($errors->has('bonuslevel3'))
								<span class="help-block">
									<strong>{{ $errors->first('bonuslevel3') }}</strong>
								</span>
								@endif
</div>
</div>

<h5><b>New Registration Bonus :</b></h5>
<br>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Registration Bonus</label>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="regbonus" value="{{$terms->regbonus}}" >
</div>
@if ($errors->has('regbonus'))
								<span class="help-block">
									<strong>{{ $errors->first('regbonus') }}</strong>
								</span>
								@endif
</div>
</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-light"><i class=""></i> Update Content</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endsection