@php
$atitle = 'withdraw';
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>{{ $withdraw->type }} History</h1>
		</header>
		@if (session('status'))
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
			</div>
		@endif
		@if (session('error'))
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button><strong>Failed!</strong> {{ session('error') }}
			</div>
		@endif
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/withdraw/' . $withdraw->currency) }}"><i class="zmdi zmdi-arrow-left"></i> Back to withdraw
							history</a>
						<br /><br />
						<form method="post" id="currency_form" action="{{ url('admin/withdraw_update') }}" autocomplete="off">
							{{ csrf_field() }}
							<input type="hidden" value="{{ $withdraw->id }}" name="id">
							<input type="hidden" value="{{ $withdraw->type }}" name="currency">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Currency</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" value="{{ $withdraw->currency }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Payment Type</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" value="{{ $withdraw->paymenttype }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							@if ($withdraw->paymenttype == "wirepayment")
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Bank Name</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="bank" class="form-control" value="{{ $withdraw->bank_name }}" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Account Number</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="account_no" class="form-control" value="{{ $withdraw->account_no }}" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Swift Code</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="swift_code" class="form-control" value="{{ $withdraw->swift_code }}" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Bank Nationality</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="countrydata" class="form-control" value="{{ $withdraw->coutryregion }}" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
							@elseif($withdraw->paymenttype == "tinypesa")
							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Name</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="account_name" class="form-control" value="{{ $withdraw->account_name }}" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Phone Number</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="account_no" class="form-control" value="{{ $withdraw->account_no }}" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
							@endif

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Transaction ID </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="tran_id" class="form-control"
											value="{{ $withdraw->txid != null ? $withdraw->txid : '-' }}" readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Requested Withdraw Amount </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="amount" class="form-control"
											value="{{ $withdraw->totalamount != null ? number_format($withdraw->totalamount, 2, '.', '') : 0 }}"
											readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Withdraw Fee </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="fee" class="form-control"
											value="{{ $withdraw->fee != null ? number_format($withdraw->fee, 2, '.', '') : 0 }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Total Receiving Amount </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="total_amount" class="form-control"
											value="{{ $withdraw->amount != null ? number_format($withdraw->amount, 2, '.', '') : 0 }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Status</label>
									</div>
								</div>
								@if ($withdraw->status == 0)
									<div class="col-md-4">
										<div class="form-group">
											<select class="form-control" name="status">
												<option value="0">Waiting for approval</option>
												<option value="1">Approved</option>
												<option value="2">Rejected</option>
											</select>
										</div>
									</div>

									<div class="col-md-12">
										<p class="text text-info">NOTE : Once you update the status as "Approved / Rejected", you can't update status
											again!</p>
									</div>
								@else
									<div class="col-md-4">
										<div class="form-group">
											<select class="form-control" disabled="">
												<option>
													@if ($withdraw->status == 1)
														Approved
													@endif
													@if ($withdraw->status == 2)
														Rejected
													@endif
													@if ($withdraw->status == 3)
														Cancelled by user
													@endif
												</option>
											</select>
										</div>
									</div>
								@endif
							</div>

							@if (in_array('write', explode(',', $AdminProfiledetails->withdrawlist)))
								@if ($withdraw->status == 0)
									<div class="form-group">
										<button type="submit" name="edit" id="btn_update" class="btn btn-light"><i class=""></i>
											Update</button>
									</div>
								@endif
							@endif
						</form>
						<hr />

					</div>
				</div>
			</div>
		</div>
	@endsection
