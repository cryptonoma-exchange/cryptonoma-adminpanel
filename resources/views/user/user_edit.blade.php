@php
$atitle = 'users';
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
						@if (session('updated_status'))
							<div class="alert alert-success">
								{{ session('updated_status') }}
							</div>
						@endif

						@if (session('updated_error'))
							<div class="alert alert-danger">
								{{ session('updated_error') }}
							</div>
						@endif

						<div class="tab-container">

							@include("user.menu")

							</br>
						</div>

						<form method="post" action="{{ url('admin/update_user/'.$userdetails->id) }}" autocomplete="off">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Full Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="fname" class="form-control" readonly disabled
											value="{{ $userdetails->name != null ? $userdetails->name : '' }}" /><i class="form-group__bar"></i>
										@if ($errors->has('fname'))
											<span class="help-block">
												<strong class="text text-danger">{{ $errors->first('fname') }}</strong>
											</span>
										@endif
									</div>

								</div>

							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Email Id</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="email" name="email" class="form-control" value="{{ $userdetails->email }}" readonly/><i
											class="form-group__bar"></i>
									</div>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong class="text text-danger">{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Country</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select class="form-control" name="country" readonly disabled>
											@if ($userdetails->country == '')
												<option value=""></option>
												@foreach (country() as $countrys)
													<option value="{{ $countrys->id }}" @if ($countrys->id == $userdetails->country) selected @endif>
														{{ $countrys->name }}</option>
												@endforeach
											@else
												@foreach (country() as $countrys)
													<option value="{{ $countrys->id }}" @if ($countrys->id == $userdetails->country) selected @endif>
														{{ $countrys->name }}</option>
												@endforeach
											@endif
										</select>
										@if ($errors->has('country'))
											<span class="help-block">
												<strong class="text text-danger">{{ $errors->first('country') }}</strong>
											</span>
										@endif

									</div>

								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone No</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="phone" class="form-control" value="{{ $phone }}" readonly disabled/><i
											class="form-group__bar"></i>
										@if ($errors->has('phone'))
											<span class="help-block">
												<strong class="text text-danger">{{ $errors->first('phone') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Address</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<textarea class="form-control" rows="3" cols="10" name="address" readonly disabled>{{ $address }}</textarea>
										@if ($errors->has('address'))
											<span class="help-block">
												<strong class="text text-danger">{{ $errors->first('address') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Email Verify</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-group">
											@if ($userdetails->email_verify == 1)
												<select name="emailcheck" class="form-control">
													<option value="1">Verified</option>
													<option value="0">Not Verify</option>
												</select>
											@else
												<select name="emailcheck" class="form-control" required>
													<option value="0">Not Verify</option>
													<option value="1">Verified</option>
												</select>
											@endif

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>2FA Access</label>
									</div>
								</div>
								<div class="col-md-4">
								@if (!empty($userdetails->twofa))
								<div class="form-group">
										<div class="form-group">

											<select name="twofactor" class="form-control">
												@if (!empty($userdetails->twofa))
													<option value="">{{ $userdetails->twofa == "email_otp" ? "Email" : "Google Authenticator" }} Enabled</option>
													<option value="1">Disable</option>
												@endif
												@if ($userdetails->twofa == 'google_otp')
													<option value="2">Change to Email OTP</option>
												@endif
											</select>
										</div>
									</div>
								@else
									<div class="form-group">
										<input type="text" class="form-control" value="Not enabled" readonly disabled/><i
											class="form-group__bar"></i>
									</div>
								@endif
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> User Deleted</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<div class="toggle-switch">

											<input type="checkbox" class="toggle-switch__checkbox" name="deleted"
												@if ($userdetails->deleted == 1) checked="" @endif value="1">
											<i class="toggle-switch__helper"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> User block</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<div class="toggle-switch">

											<input type="checkbox" class="toggle-switch__checkbox" name="user_status"
												@if ($userdetails->status == 1) checked="" @endif value="1">
											<i class="toggle-switch__helper"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> User block reason</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<textarea rows="4" name="reason_block" class="form-control">{{ $userdetails->reason }}</textarea>
									</div>
								</div>
							</div>
							{{-- <div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Pause On/Off</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<div class="toggle-switch">

											<input type="checkbox" class="toggle-switch__checkbox" name="suspend"
												@if ($userdetails->suspend == 1) checked="" @endif value="1">
											<i class="toggle-switch__helper"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> Reason to Pause</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<textarea rows="4" name="reason_block_trade" class="form-control">{{ $userdetails->tradereason }}</textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Pause Duration</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-group">
											<select name="suspend_duration" class="form-control">
												<option value="">Please select</option>
												<option value="8">8 Hours</option>
												<option value="24" @if ($userdetails->suspend_duration == '24') selected @endif>24 Hours (1 day)</option>
												<option value="72" @if ($userdetails->suspend_duration == '72') selected @endif>72 Hours (3 days)</option>
												<option value="168" @if ($userdetails->suspend_duration == '168') selected @endif>168 Hours (7 days)</option>
											</select>
										</div>
									</div>
								</div>
							</div> --}}

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		@if (session('withdraw_status'))
			<div class="alert alert-success">
				{{ session('withdraw_status') }}
			</div>
		@endif

		@if (session('withdraw_error'))
			<div class="alert alert-danger">
				{{ session('withdraw_error') }}
			</div>
		@endif

		@if (count($Bankuser) > 0)
			<div class="card">
				<div class="card-body">
					<h5 class="">BANK DETAILS</h5></br>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>S.No</th>
								<th>Bank name</th>
								{{-- <th>Bank routing number (ABA)</th> --}}
								<th>Swiftcode</th>
								<th>Account number</th>
								{{-- <th>Bank Address</th> --}}
								<th>Country</th>
								{{-- <th>Address</th> --}}

							</thead>
							<tbody>
								@php $i =1 ;@endphp
								@foreach ($Bankuser as $bank)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $bank->bank_name ? $bank->bank_name : '-' }}</td>

										{{-- <td>{{ $bank->branch_code ? $bank->branch_code : '-' }}</td> --}}
										<td>{{ $bank->swift_code ? $bank->swift_code : '-' }}</td>
										<td>{{ $bank->account_no ? $bank->account_no : '-' }}</td>
										{{-- <td>{{ $bank->bank_address ? $bank->bank_address : '-' }}</td> --}}
										<td>{{ $bank->countrydata ? $bank->countrydata : '-' }}</td>
										{{-- <td>{{ $bank->address ? $bank->address : '-' }}</td> --}}

									</tr>
									@php $i++;@endphp
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
		@endif

	@endsection
