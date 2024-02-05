@php
$atitle = 'settings';
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
	<section class="content">
		<div class="content__inner">
			<header class="content__title">
				<h1>Email Notifications</h1>
			</header>
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{ session('status') }}
				</div>
			@endif
			@if (session('disabledsuccess'))
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{ session('disabledsuccess') }}
				</div>
			@endif
			<div class="card">
				<div class="card-body">
					<form method="post" action="{{ url('admin/changeusername') }}" autocomplete="off">
						{{ csrf_field() }}
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Notify Email</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group m-0">
									<input type="text" name="notify_mail1" required="required" id="notify_mail1" class="form-control"
										value="{{ $notify_email_ids[0] }}">
									<i class="form-group__bar"></i>
								</div>

								@if ($errors->has('notify_mail1'))
									<span class="help-block">
										<strong class="text text-danger">{{ $errors->first('notify_mail1') }}</strong>
									</span>
								@endif

							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Notify Email</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group m-0">
									<input type="text" name="notify_mail2" required="required" id="notify_mail2" class="form-control"
										value="{{ $notify_email_ids[1] }}">
									<i class="form-group__bar"></i>
								</div>

								@if ($errors->has('notify_mail2'))
									<span class="help-block">
										<strong class="text text-danger">{{ $errors->first('notify_mail2') }}</strong>
									</span>
								@endif

							</div>
						</div>

						<div class="form-group">
							<button type="submit" name="save" class="btn btn-light"><i class=""></i> Save</button>
						</div>
					</form>
					@if (session('success'))
						<div class="alert alert-success" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							{{ session('success') }}
						</div>
					@endif
					@if (session('error'))
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							{{ session('error') }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>

@endsection
