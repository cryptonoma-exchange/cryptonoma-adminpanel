@php
$atitle = 'selltrade';
@endphp
@extends('layouts.header')
@section('title', ' Trade History')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Sell Trade History</h1>
		</header>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 tg-select-left">
						<select class="form-control custom-s-left" onchange="pageredirect(this)">
							<option value="{{ url('admin/sell_tradehistory/' . $tradepair->coinone . '_' . $tradepair->cointwo . '/limit') }}"
								@if ($order_type == 1) selected @endif>Limit</option>
							<option value="{{ url('admin/sell_tradehistory/' . $tradepair->coinone . '_' . $tradepair->cointwo . '/market') }}"
								@if ($order_type == 2) selected @endif>Market</option>
						</select>
					</div>
					<div class="col-md-6 tg-select">

						<select onchange="location = this.value;" class="form-control custom-s">
							@if (isset($pairs))
								<option value="{{ url('admin/sell_tradehistory/' . $tradepair->coinone . '_' . $tradepair->cointwo . '/' . $type) }}">
									{{ $tradepair->coinone }} / {{ $tradepair->cointwo }}</option>
								@foreach ($pairs as $coinones)
									@if ($coinones->coinone . '_' . $coinones->cointwo != $tradepair->coinone . '_' . $tradepair->cointwo)
										<option value="{{ url('admin/sell_tradehistory/' . $coinones->coinone . '_' . $coinones->cointwo . '/' . $type) }}">
											{{ $coinones->coinone }} / {{ $coinones->cointwo }}</option>
									@endif
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="tab-content">
					<div id="buyo" class="tab-pane fade in active show">
						<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
							<table class="table" id="dows">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>Date & Time</th>
										<th>Username</th>
										<th>Price</th>
										<th>Amount</th>
										<th>Remaining</th>
										<th>Total</th>
										<th>Trade Fee</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@forelse($selltrade as $trade)
										<tr>
											<td>{{ $loop->index + $selltrade->firstItem() }}</td>
											<td>{{ $trade->created_at }}</td>
											<td>{{ $trade->user->name }}</td>
											<td>{{ $trade->original_price }}</td>
											<td>{{ $trade->volume }}</td>
											<td>{{ $trade->remaining }}</td>
											<td>{{ $trade->value }}</td>
											<td>{{ $trade->fees }}</td>
											<td>{{ $trade->status_string }}</td>
										</tr>
									@empty
										<tr>
											<td colspan="10">
												<div class="alert alert-info">Yet no trades available</div>
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="pagination-tt clearfix">
								{{ $selltrade->links() }}
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
