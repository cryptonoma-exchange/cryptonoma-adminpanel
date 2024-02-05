@php
$atitle ="mpsadesc";
@endphp
@extends('layouts.header')
@section('title', 'Mpisa Description')
@section('content')
<section class="content">
	<div class="content__inner">
		<header class="content__title">
			<h1>Mpesa Description</h1>
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
				<form method="post" autocomplete="off" action="{{ url('admin/update_mpisa') }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="ckeditor" name="mpisa_description">
						        @if(is_object($aboutus) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $aboutus->mpisa_description) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="ckeditor" name="mpisa_mobile_description">
						        @if(is_object($aboutus) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $aboutus->mpisa_mobile_description) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="ckeditor" name="mpisa_description_withdraw">
						        @if(is_object($aboutus) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $aboutus->mpisa_description_withdraw) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="ckeditor" name="mpisa_mobile_description_withdraw">
						        @if(is_object($aboutus) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $aboutus->mpisa_mobile_description_withdraw) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
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