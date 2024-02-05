@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Coin Withdraw History</h1>
	</header>
	@if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
        </div>
    @endif
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
				<br /><br />
				<div class="tab-container">

						@include("user.menu")

						</br>
					</div>

		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.NO</th>
							<th>Date & Time</th>
							<th>Coin Name</th>
							<th>Txn Id</th>
							<th>Sender</th>
							<th>Recipient</th>
							<th>Request Amount</th>
							<th>Admin Fee</th>  
							<th>Receiving Amount</th> 							
							<th>Status</th> 
						</tr>
					</thead>
					<tbody>
					    @if(count($transaction) > 0)
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
					@foreach($transaction as $transactions)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at)) }}</td>
							<td>{{ $transactions->currency }}</td>
							<td>{{ $transactions->txid }}</td>
							<td>{{ $transactions->from_addr }}</td>
							<td>{{ $transactions->to_addr }}</td>
							<td>{{ number_format($transactions->totalamount, 8, '.', '') }}</td>				
							<td>{{ number_format($transactions->adminfee, 8, '.', '') }}</td>
							<td>{{ number_format($transactions->amount, 8, '.', '') }}</td>
							<td>
							    @if($transactions->status == 0) 
							     <a class="btn btn-success btn-xs" href="{{ url('/admin/crypto_withdraw_edit/'.\Crypt::encrypt($transactions->id)) }}"><i class="zmdi zmdi-edit"></i> View </a> 
                                @elseif($transactions->status == 2)  Cancelled
                                @elseif($transactions->status == 1) 
                                 Success
                                @endif
							</td> 
						</tr>
						@php
						    $i++;
						@endphp
					@endforeach
					@else
					    <tr><td colspan="10"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($transaction->count())
				@endif
                </div>
              </div>
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection