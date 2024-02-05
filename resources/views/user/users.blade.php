@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Users</h1>
	</header>
	<div class="card">
		<div class="card-body">


			  @if ($message = Session::get('updated_status'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
            </div>
            @endif

            
		    <form action="{{ url('/admin/users/search') }}" method="get" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-3">                
						<input type="text" name="searchitem" class="form-control" placeholder="Search for Username or Email" value= "" required=""/>
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="{{ url('admin/users') }}"> Reset </a> 
					</div>
					</form>
					<!-- <div class="col-md-3">
						<input type="button" id="btnExport" class="btn btn-success user_date" value="Export To Excel" />  

					</div> -->
				</div>
			
			<br/>

			<div class="table-responsive search_result">
				<table class="table">
					<thead>
						<tr>
							<th>Account No </th>
							<th>Date and Time</th>
							<th>Username</th>
							<th>Email Id</th>
							<th>Email Verify</th>
							<th>Kyc Verify</th>
							<th colspan="1">Action</th>
						</tr>
					</thead>
					<tbody>					    
					    @php 
			            $i =1;

			            $limit=100;

			            if(isset($_GET['page'])){
							$page = $_GET['page'];
							$i = (($limit * $page) - $limit)+1;
						}else{
						  $i =1;
						}        
						@endphp
					@forelse($details as $user)
						<tr>
							<td>{{ $user->account_number }}</td></td>
							<td>{{ date('Y/m/d h:i:s', strtotime($user->created_at)) }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>@if($user->email_verify == 1) Yes @elseif($user->email_verify == 2) Waiting @else No @endif</td>
							<td>@if($user->kyc_verify == 1) Yes @elseif($user->kyc_verify == 2) Waiting @else No @endif</td>
							<td><a class="btn btn-success btn-xs" href="{{ url('/admin/users_edit/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-edit"></i> View </a></td>

						</tr>
						 @php
				         $i++;
				         @endphp				
					@empty
					    <tr><td colspan="7"> No record found!</td></tr>
					@endforelse
					</tbody>
				</table>


					<table class="table" id="dvData" style="display: none;">
					<thead>
						<tr>
							<th>S.NO </th>
							<th>Name</th>
							<th>Email ID</th>
							<th>Phone number</th>
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
					@forelse($details as $user)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->phone_no ? $user->phone_no : '-'  }}</td>
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
         

				   @if(count($details) > 0)
                            {!! $details->appends(Request::only(['searchitem'=>'searchitem']))->render() !!} 
                    @endif

                </div>
              </div>
			</div>
		</div>
	</div>
</section>
@endsection 
    
