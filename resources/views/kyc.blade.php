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
							<th>User Name</th>
							<th>DOB</th>
							<th>Country</th>
							<th>Kyc Verify</th>
							<th>Remarks</th>
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
							<td>{{ $user->fname }} {{ $user->lname }}</td>
							<td>{{ date('m-d-Y', strtotime($user->dob)) }}</td>
							<td>{{ $user->country }}</td>
							<td>@if($user->status == 0) Waiting @elseif($user->status == 1) Accepted @elseif($user->status == 2) Rejected @else No @endif</td>
							<td>{{ $user->remark }}</td>
							@if(in_array("read", explode(',',$AdminProfiledetails->kyc)))
							  <td><a class="btn btn-success btn-xs" href="{{ url('admin/kycview/'.Crypt::encrypt($user->kyc_id)) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>  
							  @endif
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


