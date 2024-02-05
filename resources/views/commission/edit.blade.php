@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Commission Settings</h1>
		</header>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Commission</a>
						<br /><br />
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
							</div>
						@endif
						@if (session('statuserror'))
							<div class="alert alert-danger	" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Failure!</strong> {{ session('statuserror') }}
							</div>
						@endif

						@if (isset($errors) && count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<form method="post" action="{{ url('admin/commissionupdate') }}" autocomplete="off">
							{{ csrf_field() }}
							<input type="hidden" value="{{ $commission->id }}" name="id">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Coin / Currency</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="currency" class="form-control"
											value="{{ $commission->source != null ? $commission->source : '0' }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>

							{{-- <div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Network</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="network" class="form-control"
											value="{{ $commission->network != null ? $commission->network : 'NULL' }}" /><i class="form-group__bar"></i>
									</div>
								</div>
							</div> --}}
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Withdraw Commission (%)</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="withdraw" class="form-control" step="0.01" min="0" max="10000000"
											value="{{ $commission->withdraw != null ? display_format($commission->withdraw, 8) : '0' }}"
											required="" /><i class="form-group__bar"></i>
										@if ($errors->has('withdraw'))
											<span class="help-block">
												<strong>{{ $errors->first('withdraw') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Trade Buy Commission (%)</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="buy" step="0.01" min="0" max="10000000" class="form-control"
											value="{{ $commission->buy_trade != null ? display_format($commission->buy_trade, 8) : '0' }}"
											required="" /><i class="form-group__bar"></i>
										@if ($errors->has('buy'))
											<span class="help-block">
												<strong>{{ $errors->first('buy') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Trade Sell Commission (%)</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="sell" step="0.01" min="0" max="10000000" class="form-control"
											value="{{ $commission->sell_trade != null ? display_format($commission->sell_trade, 8) : 'None' }}"
											required="" /><i class="form-group__bar"></i>
										@if ($errors->has('sell'))
											<span class="help-block">
												<strong>{{ $errors->first('sell') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Minimum Deposit Amount</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="min_deposit" step="0.00001" min="0" max="10000000" class="form-control"
											value="{{ $commission->min_deposit != null ? display_format($commission->min_deposit, 8) : 0 }}"
											required="" /><i class="form-group__bar"></i>
										@if ($errors->has('min_deposit'))
											<span class="help-block">
												<strong>{{ $errors->first('min_deposit') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Minimum Withdraw Amount</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="min_withdraw" step="0.00001" min="0" max="10000000"
											class="form-control"
											value="{{ $commission->min_withdraw != null ? display_format($commission->min_withdraw, 8) : 0 }}"
											required="" /><i class="form-group__bar"></i>
										@if ($errors->has('min_withdraw'))
											<span class="help-block">
												<strong>{{ $errors->first('min_withdraw') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Minimum Unit Price </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="min_trade_price" step="0.00001" min="0" max="10000000"
											class="form-control"
											value="{{ $commission->min_trade_price != null ? display_format($commission->min_trade_price, 8) : 0 }}"
											required="" /><i class="form-group__bar"></i>
										@if ($errors->has('min_trade_price'))
											<span class="help-block">
												<strong>{{ $errors->first('min_trade_price') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<!-- 			<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Net Fee</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="netfee"  step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->netfee != null ? display_format($commission->netfee, 8) : 0 }}"  /><i class="form-group__bar"></i>
									
									</div>
								</div>
							</div> -->
							<!--
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Maximum Per Day User Withdraw Request</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="perday_withdraw"  step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->perday_withdraw != null ? display_format($commission->perday_withdraw, 8) : 0 }}" required="" /><i class="form-group__bar"></i>
										@if ($errors->has('perday_withdraw'))
	<span class="help-block">
						<strong>{{ $errors->first('perday_withdraw') }}</strong>
						</span>
	@endif
									</div>
								</div>
							</div>
		-->

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection
