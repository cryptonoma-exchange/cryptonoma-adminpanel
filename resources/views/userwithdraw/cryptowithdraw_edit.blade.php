@php
$atitle = 'withdraw';
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>View {{ $withdraw->currency }} Withdraw History</h1>
		</header>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/withdraw/' . $withdraw->currency) }}"><i class="zmdi zmdi-arrow-left"></i> Back to withdraw
							history</a>
						<br /><br />
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Success!</strong>
							</div>
						@endif

						@if (session('error'))
							<div class="alert alert-warning" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>{{ session('error') }}</strong>
							</div>
						@endif
						<form method="post" id="currency_form" action="{{ url('admin/update_cryptowithdraw') }}" autocomplete="off">
							<input type="hidden" name="id" value="{{ $withdraw->id }}">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>User Name</label>
									</div>
								</div>

								<input type="hidden" name="currency" value="{{ $withdraw->currency }}">

								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="recipient" class="form-control" value="{{ $withdraw->user->name }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Coin</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="coin" class="form-control" value="{{ $withdraw->currency }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							@if ($coin->type == "token")
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Network</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="network" class="form-control" value="{{ $withdraw->network }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							@endif
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Transaction id</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="txid" class="form-control" value="{{ $withdraw->txid }}"
											@if ($withdraw->status != 0) readonly @endif /><i class="form-group__bar" /></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Sender Address</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="recipient" class="form-control" value="{{ $withdraw->from_addr }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Recipient Address</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="recipient" class="form-control" value="{{ $withdraw->to_addr }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>

							@if ($withdraw->memo)
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Memo</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text"  class="form-control" value="{{ $withdraw->memo }}" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							@endif

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Requested Amount</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="requestedamount" class="form-control" value="{{ $withdraw->totalamount }}"
											readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Admin Fee</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="adminfee" class="form-control"
											value="{{ display_format($withdraw->adminfee, 8) }}" readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Actual Receiving Amount</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="sendamount" class="form-control" value="{{ $withdraw->amount }}" readonly /><i
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
								@elseif($withdraw->status == 1)
									<div class="col-md-4">
										<div class="form-group">
											Approved
										</div>
									</div>
								@else
									<div class="col-md-4">
										<div class="form-group">
											Rejected
										</div>
									</div>
								@endif
								<div class="col-md-12">
									<p class="text text-info">NOTE : Once you update the status as "Approved / Rejected", you can't update status
										again!</p>
								</div>
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
					</div>
				</div>
			</div>
		</div>
	@endsection
