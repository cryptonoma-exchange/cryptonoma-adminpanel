@extends('layouts.header')
@section('title', 'Instant History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1> {{ $type }} Instant History</h1>
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
						<th>User Name</th>
						<th>Payment</th>
						<th>Payment address</th>
						<th>Credit currency</th>
						<th>Credit amount</th>
						<th>Debit currency</th>
						<th>Debit amount</th>
						</tr>
					</thead>
					<tbody>
					    @if(count($Instanthistory) > 0)
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
						@foreach($Instanthistory as $transaction)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('Y-m-d h:i:s', strtotime($transaction->created_at)) }}</td>
							<td>{{ username($transaction->uid) }}</td>
							<td>{{ $transaction->paymentname }}</td>
							<td>{{ $transaction->payment_address }}</td>
							<td>{{ $transaction->credit_currency }}</td>
							@if($transaction->credit_currency = 'NGN')
							<td>{{ display_format($transaction->credit_amount,0) }}</td>
							@else
							<td>{{ display_format($transaction->credit_amount,2) }}</td>
							@endif
							<td>{{ $transaction->debit_currency }}</td>
							<td>{{ $transaction->debit_amount }}</td>
						</tr>
						@php
						    $i++;
						@endphp
					@endforeach
					@else
					<tr><td colspan="20"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				@if(count($Instanthistory) > 0)
				    {{ $Instanthistory->links() }}
				@endif
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection