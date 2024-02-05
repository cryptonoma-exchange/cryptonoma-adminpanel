@extends('layouts.header')
@section('title', 'Add sub- Admin')
@section('content')
<section class="content">
	<div class="content__inner">
		<header class="content__title">
			<h1> Sub Admin List</h1>
		</header>
		@if(Session::has('message'))
		<p class="alert alert-success">{{ Session::get('message') }}</p>
		@endif
		@if ($error = Session::get('error'))
		<div class="alert alert-warning alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $error }}</strong>
		</div>
		@endif

		<div class="card">
			<div class="card-body">
				<a href="{{ url('admin/subadminlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Sub Admin List</a>
				<br ><br >
				<div class="tab-container">                 
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" href="{{ url('/admin/subadminedit/'.Crypt::encrypt($user->id)) }}" role="tab">Sub Admin Details</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/admin/subadminchangepassword/'.Crypt::encrypt($user->id)) }}" role="tab">Sub Admin Change Password</a>
						</li>
					</ul>
					<br>
				</div>
				<form method="post" action="{{ url('admin/subadminupdate/'.$id) }}" autocomplete="off">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="username">Username</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group ctmcheck {{ $errors->has('username') ? ' has-error' : '' }}">
								<input type="text" name="username" class="form-control" value="{{ $user->name }}" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required="" />
								<i class="form-group__bar"></i> 
							</div>
							@if ($errors->has('username'))
							<span class="help-block" style="color:red;"> 
								<strong>{{ $errors->first('username') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group ctmcheck">
								<input type="email" name="email" onkeypress="return AvoidSpace(event)" required pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" class="form-control" value="{{ $user->email }}" required="" readonly/>
								<i class="form-group__bar"></i>
							</div>
							@if ($errors->has('email'))
							<span class="help-block" style="color:red;">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<hr>
					<div class="checkmrkbox">
						<header class="content__title"><h1>Dashboard</h1></header>
						<div class="row">
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type="checkbox" name="dashboard[]" class="checkmark" @if(in_array("withdraw_view", explode(',',$profile['dashboard']))) checked @endif value="withdraw_view" />
										<span class="checkmark">Coin Withdraw</span>
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type="checkbox" name="dashboard[]" class="checkmark" @if(in_array("kyc_view", explode(',',$profile['dashboard']))) checked @endif value="kyc_view" />
										<span class="checkmark">Kyc</span>
									</label>
								</div>
							</div>


							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type="checkbox" name="dashboard[]" class="checkmark"  @if(in_array("user_view", explode(',',$profile['dashboard']))) checked @endif value="user_view" />
										<span class="checkmark">User View</span>
									</label>
								</div>
							</div>
						
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type="checkbox" name="dashboard[]" class="checkmark" @if(in_array("support_view", explode(',',$profile['dashboard']))) checked @endif value="support_view" />
										<span class="checkmark">Support</span>
									</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mb-20 mt-20">
							<div class="col-md-3"></div>
							<div class="col-md-3"><h5>Read</h5></div>
							<div class="col-md-3"><h5>Write</h5></div>
							<div class="col-md-3"><h5>Delete</h5></div>
						</div>
						<br>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Deposit List</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="depositlist[]" class="checkmark" @if(in_array("read", explode(',',$profile['depositlist']))) checked @endif value="read" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="depositlist[]" class="checkmark" @if(in_array("write", explode(',',$profile['depositlist']))) checked @endif value="write" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Withdraw List</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="withdrawlist[]" class="checkmark" @if(in_array("read", explode(',',$profile['withdrawlist']))) checked @endif value="read" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="withdrawlist[]" class="checkmark" @if(in_array("write", explode(',',$profile['withdrawlist']))) checked @endif value="write" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
								</div>
							</div>
						</div>
	
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>KYC</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="kyc[]" class="checkmark" @if(in_array("read", explode(',',$profile['kyc']))) checked @endif value="read" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="kyc[]" class="checkmark" @if(in_array("write", explode(',',$profile['kyc']))) checked @endif value="write" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
								</div>
							</div>
						</div>
					
		
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Subscribe</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="subscribe[]" class="checkmark" @if(in_array("read", explode(',',$profile['subscribe']))) checked @endif value="read" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="subscribe[]" class="checkmark" @if(in_array("write", explode(',',$profile['subscribe']))) checked @endif value="write" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="subscribe[]" class="checkmark" @if(in_array("delete", explode(',',$profile['subscribe']))) checked @endif value="delete" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Contact</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="contact[]" class="checkmark" @if(in_array("read", explode(',',$profile['contact']))) checked @endif value="read" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="contact[]" class="checkmark" @if(in_array("write", explode(',',$profile['contact']))) checked @endif value="write" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="contact[]" class="checkmark" @if(in_array("delete", explode(',',$profile['contact']))) checked @endif value="delete" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Support</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="support[]" class="checkmark" @if(in_array("read", explode(',',$profile['support']))) checked @endif value="read" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
									<label>
										<input type="checkbox" name="support[]" class="checkmark" @if(in_array("write", explode(',',$profile['support']))) checked @endif value="write" />
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-check">
								</div>
							</div>
						</div>
				
					</div>
					@if(in_array("write", explode(',',$AdminProfiledetails->addadmin)))
					<div class="row">
						<div class="col-md-12">        
							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</form>
	</div>
</div>
</div>
@endsection