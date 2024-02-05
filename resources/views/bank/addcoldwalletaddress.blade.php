@php
$atitle ="addcoldwalletaddress";
@endphp
@extends('layouts.header')
@section('title', 'addcoldwalletaddress')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>ADD Cold wallet address</h1>
	</header>
	@if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
        </div>
    @endif
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/coldwalletaddress') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Cold wallet address Details</a>
					<br /><br />  
					<form method="post" action="{{ url('admin/coldwalletaddressadd') }}" autocomplete="off">
						{{ csrf_field() }}
					

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>btc address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('btc_address') ? ' has-error' : '' }}">
							<input type="text" name="btc_address" value="" class="form-control" required="required">
							@if ($errors->has('btc_address'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('btc_address') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>bnb address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('bnb_address') ? ' has-error' : '' }}">
							     
									<input type="text" name="bnb_address" value="" class="form-control" required="required">											   
							   @if ($errors->has('bnb_address'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('bnb_address') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>ltc address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('ltc_address') ? ' has-error' : '' }}">
							<input type="text" name="ltc_address" value="" class="form-control" required="required">
							@if ($errors->has('ltc_address'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('ltc_address') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>xrp address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('xrp_address') ? ' has-error' : '' }}">
							<input type="text" name="xrp_address" value="" class="form-control" required="required" >
							@if ($errors->has('xrp_address'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('xrp_address') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>bch address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('bch_address') ? ' has-error' : '' }}">
							<input type="text" name="bch_address" value="" class="form-control" required="required" >
							@if ($errors->has('bch_address'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('bch_address') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>


							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>eth address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('eth_address') ? ' has-error' : '' }}">
							<input type="text" name="eth_address" value="" class="form-control" required="required" >
							@if ($errors->has('eth_address'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('eth_address') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

								

						{{-- <input type="hidden" value="{{ $fiat }}" name="fiat"> --}}
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection