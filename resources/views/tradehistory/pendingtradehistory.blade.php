@php
$atitle = 'pendingorder';
@endphp
@extends('layouts.header')
@section('title', ' Trade History')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Pending Trade History</h1>
		</header>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2 tg-select">
						<select onchange="location = this.value;" class="form-control custom-s">
							@if (isset($pairs))
								<option value="{{ url('admin/pending_tradehistory/all/' . $ordertype) }}"
									@if ($type == 'all') selected="" @endif>ALL</option>
								@foreach ($pairs as $coinones)
									<option value="{{ url('admin/pending_tradehistory/' . $coinones->coinone . '_' . $coinones->cointwo . '/' . $ordertype) }}"
										@if ($coinones->coinone . '_' . $coinones->cointwo == $type) Selected @endif> {{ $coinones->coinone }}/{{ $coinones->cointwo }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="col-md-2 tg-select">

						<select onchange="location = this.value;" class="form-control custom-s">
							<option value="{{ url('admin/pending_tradehistory/' . $type . '/Buy') }}"
								@if ($ordertype == 'Buy') selected="" @endif>Buy</option>
							<option value="{{ url('admin/pending_tradehistory/' . $type . '/Sell') }}"
								@if ($ordertype == 'Sell') selected="" @endif>Sell</option>
						</select>
					</div>
				</div>
				<div class="tab-content">
					<div id="buyo" class="tab-pane fade in active show">
						<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
							@if (session('cancelsuccess'))
								<div class="alert alert-success alert-block">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>{{ session('cancelsuccess') }}</strong>
								</div>
							@endif
							@if (session('cancelerror'))
								<div class="alert alert-warning alert-block">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>{{ session('cancelerror') }}</strong>
								</div>
							@endif
							<table class="table">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Email</th>
										<th>Date & Time</th>
										<th>Trade Pair</th>
										<th>Trade Type</th>
										<th>Amount</th>
										<th>Price</th>
										<th>Remaining</th>
										<th>Fees</th>
										<th>Total Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@forelse($trades as $order)
										<tr>
											<td>{{ $loop->index + $trades->firstItem() }}</td>
											<td>{{ $order->user->email }}</td>
											<td>{{ $order->created_at }}</td>
											<td>{{ $order->pair_string }}</td>
											<td>{{ $order->type }}</td>
											<td>{{ $order->volume }}</td>
											<td>{{ $order->original_price }}</td>
											<td>{{ $order->remaining }}</td>
											<td>{{ $order->fees }}</td>
											<td>{{ $order->value }}</td>
											<td><a href="{{ url('admin/cancelOrder/' .$order->type."/". $order->id) }}" class="btn btn-warning">Cancel</a></td>
										</tr>
									@empty
										<tr>
											<td colspan="12">
												<div class="alert alert-info">Yet no trades available</div>
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="pagination-tt clearfix">
									{{ $trades->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	@endsection
	<script>
		function pageredirect(self) {
			window.location.href = self.value;
		}
	</script>
