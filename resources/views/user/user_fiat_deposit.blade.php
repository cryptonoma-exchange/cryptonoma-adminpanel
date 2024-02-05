@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Currency deposit history</h1>
	</header>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
					<br /><br />
					@if(session('updated_status'))
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
							<th>Currency</th>
							<th>Deposited Amount</th>
							<th>Credited Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    @if(count($deposit) > 0)
					    @php 
						        $i =1;
					            $limit=15;
					            if(isset($_GET['page'])){
									$page = $_GET['page'];
									$i = (($limit * $page) - $limit)+1;
								}else{
								  $i =1;
								}        
							@endphp
						@foreach($deposit as $transactions)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('Y-m-d h:i:s', strtotime($transactions->created_at)) }}</td>
							<td>{{ $transactions->currency }}</td>
							<td>{{ number_format($transactions->amount, 2, '.', '') }}</td>
							<td>{{ number_format($transactions->credit_amount, 2, '.', '') }}</td>
							<td>
							    @if($transactions->status == 0) 
							    	Waiting for admin confirmation
                                @elseif($transactions->status == 2) 	
                                	Rejected by admin
                                @elseif($transactions->status == 3) 
                                	Cancelled by user
                                @else 
                                	Approved by admin 
                                @endif
							</td>
							<td>
								@if($transactions->status == 0) 
									<a class="btn btn-success btn-xs" href="{{ url('/admin/fiatdeposit_edit/'.Crypt::encrypt($transactions->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
                                @else 
                                	--
                                @endif 

							</td>
						</tr>
						@php
				         		$i++;
				         	@endphp 
					@endforeach
					@else
					    <tr><td colspan="7"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				@if(count($deposit) > 0)
				    {{ $deposit->links() }}
				@endif
			</div>

				</div>
			</div>
		</div>
	</div>
@endsection