@php
$atitle = 'users';
@endphp
@extends('layouts.header')
@section('title', 'Users Kyc - Admin')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>User Kyc</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
						<br /><br />
						@if (session('updated_status'))
							<div class="alert alert-success">
								{{ session('updated_status') }}
							</div>
						@endif

						<div class="tab-container">

							@include("user.menu")

							</br>
						</div>
						<div class="table-responsive search_result">

							<table class="table" id="dows">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Date & Time</th>
										<th>Username</th>
										<th>Email ID</th>
										<th>Status</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									@php
										$i = 1;
										$limit = 10;
										if (isset($_GET['page'])) {
										    $page = $_GET['page'];
										    $i = $limit * $page - $limit + 1;
										} else {
										    $i = 1;
										}
									@endphp
									@forelse($kyc as $key => $user)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ date('m-d-Y H:i:s', strtotime($user->created_at)) }}</td>
											<td>{{ $user->user['name'] }}</td>
											<td>{{ $user->user['email'] }}</td>
											<td>
												@if ($user->status == 0)
													Initialized
												@elseif($user->status == 1)
													Accepted
												@elseif($user->status == 2)
													Rejected
												@elseif($user->status == 3)
													Waiting
												@else
													No
												@endif
											</td>
											<td>{{ $user->remark }}</td>
										</tr>
										@php
											$i++;
										@endphp
									@empty
										<tr>
											<td colspan="7"> No record found!</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="pagination-tt clearfix">
								@if ($kyc->count())
									{{ $kyc->links() }}
								@endif
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	@endsection
