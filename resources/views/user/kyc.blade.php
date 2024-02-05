@php
	$atitle = 'kycview';
@endphp
@extends('layouts.header')
@section('title', 'Kyc List - Admin')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Kyc Submit</h1>
		</header>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive search_result">
					<table class="table" id="dows">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date & Time</th>
								<th>Username</th>
								<th>Email Id</th>
								<th>Status</th>
								<th>Remarks</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($kycs as $kyc)
								<tr>
									<td>{{ $loop->index + $kycs->firstItem() }}</td>
									<td>{{ date('m-d-Y H:i:s', strtotime($kyc->created_at)) }}</td>
									<td>{{ $kyc->user['name'] }}</td>
									<td>{{ $kyc->user['email'] }}</td>
									<td>
										@if ($kyc->status == 0)
											Initialized
										@elseif($kyc->status == 1)
											Accepted
										@elseif($kyc->status == 2)
											Rejected
										@elseif($kyc->status == 3)
											Waiting
										@else
											No
										@endif
									</td>
									<td>{{ $kyc->remark }}</td>
									<td><a class="btn btn-success btn-xs" href="{{ url('/admin/kycview/' . Crypt::encrypt($kyc->kyc_id)) }}"><i
												class="zmdi zmdi-edit"></i> View </a></td>
								</tr>
							@empty
								<tr>
									<td colspan="7"> No record found!</td>
								</tr>
							@endforelse
						</tbody>
					</table>
					<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
						<div class="pagination-tt clearfix">
							@if ($kycs->count())
								{{ $kycs->links() }}
							@endif
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
@endsection
