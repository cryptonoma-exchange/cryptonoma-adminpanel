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
					<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
					<br /><br />
					@if(session('updated_status'))
					    <div class="alert alert-success">
                              {{ session('updated_status') }}
                        </div>
					@endif

					@if(session('updated_error'))
					    <div class="alert alert-danger">
                              {{ session('updated_error') }}
                        </div>
					@endif

					<div class="tab-container">

						<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
						<a class="nav-link " href="{{ url('/admin/users_edit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">User Details</a>
						</li>
						<!-- 	<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC') }}" role="tab">Transactions</a>
						</li> -->
						
						<li class="nav-item">
						<a class="nav-link active" href="{{ url('/admin/users_referral/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Referral</a>
						</li>

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
						<a class="nav-link" href="{{ url('/admin/user_buy_tradehistory/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Buy trade</a>
						</li>

						
						<li class="nav-item">
						<a class="nav-link"  href="{{ url('/admin/user_sell_tradehistory/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Sell trade</a>
						</li>
						</ul>

						</br>
					</div>

					<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
						<table class="table" id="dows">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone no</th>
									<th>Referral id</th>
									<th>Created</th>
								</tr>
							</thead>
							<tbody>
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
							@forelse($userref as $user)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->phone_no }}</td>
									<td>{{ $user->referral_id }}</td>
									<td>{{ $user->created_at }}</td>
									
								</tr>
								@php
						         $i++;
						         @endphp
								@empty
								<tr><td colspan="10"><div class="alert alert-info">Yet no user available</div></td></tr>
								@endforelse
							</tbody>
						</table>
					</div>


				</div>
			</div>
		</div>
	</div>
