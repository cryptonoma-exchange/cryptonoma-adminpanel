@php
$atitle ="homepage";
@endphp
@extends('layouts.header')
@section('title', 'Home banner')
@section('content')
<section class="content">
	<div class="content__inner">
		<header class="content__title">
			<h1>Home banner Content</h1>
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
				<form method="post" autocomplete="off" action="{{ url('admin/save_homepage') }}">
					{{ csrf_field() }}
					<div class="row">


						<div class="col-md-3">
							<div class="form-group">
								<label>Title</label>
							</div>
						</div>

						<div class="col-md-8">

							<div class="form-group">
								<textarea class="form-control" rows="3" name="homebanner_title" required="">						                                                                                 @if(is_object($terms) > 0)
									@php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $terms->homebanner_title) @endphp
									{{ $data }}
									@endif
								</textarea>
								@if ($errors->has('homebanner_title'))
								<span class="help-block">
									<strong>{{ $errors->first('homebanner_title') }}</strong>
								</span>
								@endif
							</div>


						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Description</label>
							</div>
						</div>

						<div class="col-md-8">

							<div class="form-group">
								<textarea class="form-control" rows="3" name="homebanner" required="">						                               @if(is_object($terms) > 0)
									@php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $terms->homebanner) @endphp
									{{ $data }}
									@endif
								</textarea>

								@if ($errors->has('homebanner'))
								<span class="help-block">
									<strong>{{ $errors->first('homebanner') }}</strong>
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