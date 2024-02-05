@php
$atitle ="adminwallet";
@endphp
@extends('layouts.header')
@section('title', 'Admin Wallet')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Admin Wallet</h1>
	</header>
	<div class="card">
		<div class="card-body">
		<div class="table-responsive search_result">				
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Coins/Token/Currency</th>
							<th>Address</th>
							<!-- <th>Balance</th>
							<th colspan="2">Action</th> -->
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
					@forelse($result as $key => $user)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $user->asset }}</td>
							<td>{{ $user->address ? $user->address : '-' }}</td>
							<!-- <td>{{ $user->balance ? $user->balance : '-'  }}</td> -->
							<!-- <td><a class="btn btn-success btn-xs" href="{{ url('admin/walletview/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-edit"></i> View </a> </td> -->
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
                    @if($result->count())
				    {{ $result->links() }}
				@endif
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
@endsection


