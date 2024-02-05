@php
$atitle ="deposit";
@endphp
@extends('layouts.header')
@section('title', '{{ $coin }} List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>{{ $coin }} Deposit History</h1>
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
							<th>Txn Id</th>
							<th>Sender</th>
							<th>Recipient</th>
							<th>Amount</th>
							<th style="min-width: 250px">Reason</th>
							@if(in_array("read", explode(',',$AdminProfiledetails->depositlist)))
							<th colspan="2">Action</th>@endif
						</tr>
					</thead>
					<tbody>					
					@if($depositList->count())
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
					@foreach($depositList as $key => $histroy)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('d-m-Y H:i:s', strtotime($histroy->created_at)) }}</td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($histroy->uid)) }} ">{{ $histroy->user['name'] }}</a></td>
							<td>{{ $histroy->txid }}</td>
							<td>{{ $histroy->from_addr ? $histroy->from_addr : '-'  }}</td>
							<td>{{ $histroy->to_addr }}</td>
							<td>{{ display_format($histroy->amount,8) }}</td>
							<td style="white-space: normal;">{{ $histroy->remark }}</td>
							@if(in_array("read", explode(',',$AdminProfiledetails->depositlist)))
							<td>
							@if($histroy->status==0)
							<a class="btn btn-success btn-xs" href="{{ url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
							@elseif($histroy->status==2)
								<a class="btn btn-success btn-xs" href="{{ url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
							@elseif($histroy->status==3)
								Cancelled
								@else
								-
							@endif 
							</td>
							@endif
						</tr> 
						@php
						    $i++;
						@endphp
					@endforeach
				@else 
					<td colspan="15">	{{ 'No record found! ' }}</td>
				@endif
					</tbody>
				</table>
				
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($depositList->count())
				    {{ $depositList->links() }}
				@endif
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
@endsection


