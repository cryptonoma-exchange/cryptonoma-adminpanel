@php
$atitle ="privacy";
@endphp
@extends('layouts.header')
@section('title', 'Terms & Conditions')
@section('content')
<section class="content">
<div class="content__inner">
	<header class="content__title">
		<h1>Privacy Policy</h1>
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
			<form method="post" autocomplete="off" action="{{ url('admin/update_privacy') }}">
			    {{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						   <textarea class="ckeditor" name="privacy">
						        @if(is_object($privacy) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $privacy->privacy_policy) @endphp
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