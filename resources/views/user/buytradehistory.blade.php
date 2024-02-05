@php
$atitle = 'users';
@endphp
@extends('layouts.header')
@section('title', ' Trade History')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Buy Trade History</h1>
		</header>

		<div class="card">
			<div class="card-body">
				<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
				<br /><br />
				<div class="tab-container">

					@include('user.menu')

					</br>
				</div>

				<div class="tab-content">
					<div id="buyo" class="tab-pane fade in active show">
						<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
							<table class="table" id="dows">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>Date & Time</th>
										<th>Order Type</th>
										<th>Price</th>
										<th>Amount</th>
										<th>Remaining</th>
										<th>Total</th>
										<th>Trade Fee</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@forelse($buytrade as $trade)
										<tr>
											<td>{{ $loop->index + $buytrade->firstItem() }}</td>
											<td>{{ $trade->created_at }}</td>
											<td>{{ $trade->order_type_string }}</td>
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
									{{ $buytrade->links() }}
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
