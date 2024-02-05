@php
$atitle ="incomeview";
@endphp
@extends('layouts.header')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Income certificate Submit</h1>
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
							<th>Kyc Verify</th>
							<th>Status</th>
							<th>Remarks</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					 @php 
					        $i =1;
				            $limit=10;
				            if(isset($_GET['page'])){
								$page = $_GET['page'];
								$i = (($limit * $page) - $limit)+1;
							}else{
							  $i =1;
							}        
						@endphp 
					@forelse($kyc as $key => $user)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('m-d-Y H:i:s', strtotime($user->created_at)) }}</td>
							<td>{{ $user->user['name'] }}</td>
							<td>{{ $user->user['email'] }}</td>
							<td>@if($user->income_status == 0) Waiting @elseif($user->income_status == 1) Accepted @elseif($user->income_status == 3) Rejected @endif</td>
							<td>{{ $user->remark }}</td>
							<td><a class="btn btn-success btn-xs" href="{{ url('/admin/incomekycview/'.Crypt::encrypt($user->kyc_id)) }}"><i class="zmdi zmdi-edit"></i> View </a></td>
						</tr> 
					@php
				         $i++;
				         @endphp
				    @empty
					    <tr><td colspan="7"> No record found!</td></tr>
					@endforelse
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($kyc->count())
				    {{ $kyc->links() }}
				@endif
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
@endsection