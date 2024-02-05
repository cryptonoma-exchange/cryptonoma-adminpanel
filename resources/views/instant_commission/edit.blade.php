@extends('layouts.header')
@section('title', 'Instant Commission Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Instant Commission Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/instant_commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Instant Commission</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/instant_commissionupdate') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $BuySellCommission->id }}" name="id">
		

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Payment name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="name" class="form-control" value="{{ $BuySellCommission->name != NULL ? $BuySellCommission->name : '0' }}" readonly="" /><i class="form-group__bar"></i>

									@if ($errors->has('name'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('name') }}</strong>
					                    </span>
					                @endif

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Payment Source</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="source" class="form-control" value="{{ $BuySellCommission->source != NULL ? $BuySellCommission->source : '0' }}" readonly="" /><i class="form-group__bar"></i>
										@if ($errors->has('source'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('source') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Buy amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="buyamount" class="form-control" value="{{ $BuySellCommission->buy != NULL ? display_format($BuySellCommission->buy,8) : '0' }}" min='1'/><i class="form-group__bar"></i>
									@if ($errors->has('buyamount'))
									<span class="help-block">
									<strong>{{ $errors->first('buyamount') }}</strong>
									</span>
									@endif

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Sell amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="sellamount" class="form-control" value="{{ $BuySellCommission->sell != NULL ? display_format($BuySellCommission->sell,8) : '0' }}" min='1'/><i class="form-group__bar"></i>

									@if ($errors->has('sellamount'))
									<span class="help-block">
									<strong>{{ $errors->first('sellamount') }}</strong>
									</span>
									@endif

								</div>
							</div>
						</div>

					<!-- 	<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Buy commission</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="buy_commission" class="form-control" step="0.01" min="0" max="10000000" value="{{ $BuySellCommission->buy_commission != NULL ? display_format($BuySellCommission->buy_commission,8) : '0' }}"/><i class="form-group__bar"></i>

									@if ($errors->has('buy_commission'))
									<span class="help-block">
									<strong>{{ $errors->first('buy_commission') }}</strong>
									</span>
									@endif

								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Sell commission</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="sell_commission" class="form-control" step="0.01" min="0" max="10000000" value="{{ $BuySellCommission->sell_commission != NULL ? display_format($BuySellCommission->sell_commission,8) : '0' }}"/><i class="form-group__bar"></i>

									@if ($errors->has('sell_commission'))
									<span class="help-block">
									<strong>{{ $errors->first('sell_commission') }}</strong>
									</span>
									@endif

								</div>
							</div>
						</div> -->
						

						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection