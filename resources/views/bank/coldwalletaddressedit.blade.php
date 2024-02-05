@php
$atitle = 'coldwalletaddress';
@endphp
@extends('layouts.header')
@section('title', 'edit Cold wallet address')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Cold wallet address</h1>
		</header>

		@if (session('status'))
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
			</div>
		@endif

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						{{-- <a href="{{ url('admin/coldwalletaddress') }}"><i class="zmdi zmdi-arrow-left"></i> Back to cold
                            wallet address list</a>
                        <br /><br /> --}}

						<div class="row">
							{{-- <div class="col-md-6 tg-select-left">

                            </div> --}}
							<div class="col-12 tg-select">

								<form action="{{ url('admin/coldwalletaddress/update') }}" method="post">
									@csrf

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>BTC address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('btc_address') ? ' has-error' : '' }}">
												<input type="text" name="btc_address" value="{{ $coldwallet->btc_address }}" class="form-control"
													required="required">
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
												<label>BNB address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('bnb_address') ? ' has-error' : '' }}">

												<input type="text" name="bnb_address" value="{{ $coldwallet->bnb_address }}" class="form-control"
													required="required">
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
												<label>LTC address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('ltc_address') ? ' has-error' : '' }}">
												<input type="text" name="ltc_address" value="{{ $coldwallet->ltc_address }}" class="form-control"
													required="required">
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
												<label>XRP address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('xrp_address') ? ' has-error' : '' }}">
												<input type="text" name="xrp_address" value="{{ $coldwallet->xrp_address }}" class="form-control"
													required="required">
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
												<label>XRP Tag</label>
											</div>
										</div>
										<div class="col-md-6">
                                            <div class="form-group {{ $errors->has('xrp_tag') ? ' has-error' : '' }}">
												<input type="text" name="xrp_tag" value="{{ $coldwallet->xrp_tag }}" class="form-control"
													required="required">
												@if ($errors->has('xrp_tag'))
													<span class="help-block">
														<strong>{{ $errors->first('xrp_tag') }}</strong>
													</span>
												@endif
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>BCH address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('bch_address') ? ' has-error' : '' }}">
												<input type="text" name="bch_address" value="{{ $coldwallet->bch_address }}" class="form-control"
													required="required">
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
												<label>ETH address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group {{ $errors->has('eth_address') ? ' has-error' : '' }}">
												<input type="text" name="eth_address" value="{{ $coldwallet->eth_address }}" class="form-control"
													required="required">
												@if ($errors->has('eth_address'))
													<span class="help-block">
														<strong>{{ $errors->first('eth_address') }}</strong>
													</span>
												@endif
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="alert alert-danger" role="alert">
											Warning:
											<ul class="mb-0">
												<li>Please be careful before changing the cold wallet address.</li>
												<li>All user deposits will be moved to this cold wallet address only.</li>
												<li>Double check before updating the cold wallet address.</li>
											</ul>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-light"><i class=""></i> Submit</button>
									</div>

								</form>

							</div>
						</div>
						<div class="table-responsive search_result">

						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
@endsection
