@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Leverages Commission Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/leverage_commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Leverages Commission</a>
					<br /><br />
					@if(session('add_status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('add_status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/le_commissionAdd') }}" autocomplete="off">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Title</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="title" class="form-control" value=""/><i class="form-group__bar"></i>
									@if ($errors->has('title'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('title') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Value</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="value" class="form-control"  step="0.01" min="0" max="10000000" value=""/><i class="form-group__bar"></i>
									@if ($errors->has('value'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('value') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div> 
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Commission</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="commission"  step="0.01" min="0" max="10000000" class="form-control" value=""/><i class="form-group__bar"></i>
									@if ($errors->has('commission'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('commission') }}</strong>
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