@extends('layouts.header')
@section('title', 'Live price Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Live price Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/liveprice') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Liveprice</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                    @if(session('statuserror'))
                        <div class="alert alert-danger	" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failure!</strong> {{ session('statuserror') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/livepriceadd') }}" autocomplete="off">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin / Token</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">

									<select name="coin" class="form-control">
										@foreach($Commission as $val)
										<option>{{ $val->source }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Price</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="price" class="form-control" value=""/><i class="form-group__bar"></i>
									@if ($errors->has('price'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('price') }}</strong>
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