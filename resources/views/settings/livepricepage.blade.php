@php
$atitle ="liveprice";
@endphp
@extends('layouts.header')
@section('title', 'Home Live price')
@section('content')
<section class="content">
<div class="content__inner">
	<header class="content__title">
		<h1>live price view</h1>
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
			<form method="post" autocomplete="off" action="{{ url('admin/view_liveprice') }}">
			    {{ csrf_field() }}

			    				<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Want show live price in landing page</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="liveprice">

						<option value="0" <?php if($terms->homepage_liveprice_view== 0) echo "selected"; ?>>Hide</option>
						<option value="1" <?php if($terms->homepage_liveprice_view== 1) echo "selected"; ?>>Show</option>
						</select>
						   @if ($errors->has('liveprice'))
							<span class="help-block">
							<strong>{{ $errors->first('liveprice') }}</strong>
							</span>
							@endif


								</div>
							</div>
						</div>


				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-light"><i class=""></i> Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection