@php
$atitle = 'deposit';
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1> {{ $coin }} Deposit History</h1>
		</header>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive search_result">
							<table class="table" id="dows">

								<thead>
									<tr>
										<th>S.No</th>
										<th>Date & Time</th>
										<th>Withdraw Type</th>
										<th>Username</th>
										<th>Txn Id</th>
										<th>Deposited Amount ({{ $coin }})</th>
										<th>Credit Amount ({{ $coin }})</th>
										<th style="min-width: 250px">Reason</th>
										<th>Status</th>
										@if (in_array('write', explode(',', $AdminProfiledetails->depositlist)))
											<th>Action</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@if (count($deposit) > 0)
										@php
											$i = 1;
											
											$limit = 15;
											
											if (isset($_GET['page'])) {
											    $page = $_GET['page'];
											    $i = $limit * $page - $limit + 1;
											} else {
											    $i = 1;
											}
										@endphp
										@foreach ($deposit as $transactions)
											<tr>
												<td>{{ $i }}</td>
												<td>{{ date('Y-m-d h:i:s', strtotime($transactions->created_at)) }}</td>
												<td>{{ $transactions->paymenttype }}</td>
												<td>{{ username($transactions->uid) }}</td>
												<td>{{ $transactions->txid ? $transactions->txid : '-' }}</td>
												<td>{{ display_format($transactions->amount, 8) }}</td>
												<td>{{ display_format($transactions->credit_amount, 8) }}</td>
												<td style="white-space: normal;">{{ $transactions->remark }}</td>
												<td>
													@if ($transactions->paymenttype == 'tinypesa')
														@if ($transactions->status == 0)
															Pending
														@elseif($transactions->status == 2)
															Failed
														@elseif($transactions->status == 3)
															@lang('common.Cancelled by user')
														@else
															Success
														@endif
													@else
														@if ($transactions->status == 0)
															Waiting for admin confirmation
														@elseif($transactions->status == 2)
															Rejected by admin
														@elseif($transactions->status == 3)
															Cancelled by user
														@else
															Approved by admin
														@endif
													@endif
												</td>
												@if (in_array('write', explode(',', $AdminProfiledetails->depositlist)))
													<td>
														@if ($transactions->paymenttype == 'tinypesa')
															--
														@elseif($transactions->status == 0)
															<a class="btn btn-success btn-xs"
																href="{{ url('/admin/fiatdeposit_edit/' . Crypt::encrypt($transactions->id)) }}"><i
																	class="zmdi zmdi-edit"></i> View </a>
														@else
															--
														@endif

													</td>
												@endif
											</tr>
											@php
												$i++;
											@endphp
										@endforeach
									@else
										<tr>
											<td colspan="7"> No record found!</td>
										</tr>
									@endif
								</tbody>
							</table>
							@if (count($deposit) > 0)
								{{ $deposit->links() }}
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
