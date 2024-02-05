@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>View User Details</h1>
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

						<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
						<a class="nav-link " href="{{ url('/admin/users_edit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">User Details</a>
						</li>
					<!-- 	<li class="nav-item">
						<a class="nav-link active" href="{{ url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC') }}" role="tab">Transactions</a>
						</li> -->
						

						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/userkyc/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Kyc</a>
						</li>

						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Wallet</a>
						</li>


						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin<br>Deposit</a>
						</li>
					
						
						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin<br>Withdraw</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/userfiatdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Currency<br>Deposit</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_fiat_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Currency<br>Withdraw</a>
						</li>
						
						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_buy_tradehistory/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Buy trade</a>
						</li>

						
						<li class="nav-item">
						<a class="nav-link"  href="{{ url('/admin/user_sell_tradehistory/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Sell trade</a>
						</li>
						</ul>

						</br>
					</div>

					<div class="row">

						<div class="col-md-6 col-sm-6 col-xs-12 tg-select-left cryptoleftb">
					<select onchange="location = this.value;" class="form-control custom-s-left">

					@if(isset($Commission))

					@foreach($Commission as $value) 
					<option <?php if($coin == $value->source){ echo 'selected' ;} ?> value="{{ url('admin/transactionall/'.$id.'/'.$value->source) }}">{{ $value->source }}</option>


					@endforeach
					@endif

					</select>
				</div>
					</div>

							<div class="table-responsive search_result">

	

							<table class="table" id="dows">
							<thead>
							<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>Type</th>
							<th>Credit balance</th>
							<th>Debit balance</th>
							<th>Wallet Balance</th>
							<th>Exits balance</th>
							<th>Updatefrom</th>
							<th>Remark</th>
							</tr>
							</thead>
						<tbody>					
						@if($results->count())
						@foreach($results as $key => $histroy)
						<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ date('Y-m-d h:i:s', strtotime($histroy->created_at)) }}</td>
						<td>{{ $histroy->type ? $histroy->type : '-' }}</td>
						<td>{{ $histroy->credit ? $histroy->credit : '-' }}</td>
						<td>{{ $histroy->debit  ? $histroy->debit  : '-'}}</td>
						<td>{{ $histroy->balance ? $histroy->balance : '-' }}</td>
						<td>{{ $histroy->oldbalance ? $histroy->oldbalance : '-' }}</td>
						<td>{{ $histroy->update_from ? $histroy->update_from : '-' }}</td>

						<td>{{ $histroy->remark  ? $histroy->remark :'-'}}</td>


						</tr> 
						@endforeach
						@else 
						<td colspan="20">	{{ 'No record found! ' }}</td>
						@endif
						</tbody>
							</table>
						</div>

							<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($results->count())
				    {{ $results->links() }}
				@endif
                </div>
              </div>

				</div>
			</div>
		</div>
	</div>
	

@endsection