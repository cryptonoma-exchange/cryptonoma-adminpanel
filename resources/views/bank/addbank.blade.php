@php
$atitle ="adminbank";
@endphp
@extends('layouts.header')
@section('title', 'Add bank')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Add {{ $fiat }} Bank Details</h1>
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
					<a href="{{ url('admin/bank/'.$fiat) }}"><i class="zmdi zmdi-arrow-left"></i> Back to Company Bank Details</a>
					<br /><br />  
					<form method="post" action="{{ url('admin/bankadd') }}" autocomplete="off">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Select Currency</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('coin') ? ' has-error' : '' }}">
								
									<select class="form-control" name="coin">
					
										<option value="{{ $fiat }}">{{ $fiat }}</option>
									</select>
									@if ($errors->has('coin'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('coin') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Bank Name</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('bank_name') ? ' has-error' : '' }}">
							<input type="text" name="bank_name" value="" class="form-control" required="required" onkeyup="if (/[^a-zA-Z ]/g.test(this.value)) this.value = this.value.replace(/[^a-zA-Z ]/g,'')">
							@if ($errors->has('bank_name'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('bank_name') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Account Type</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('accounttype') ? ' has-error' : '' }}">
							     
									<input type="text" name="accounttype" value="" class="form-control" required="required">											   
							   @if ($errors->has('accounttype'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('accounttype') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Account Name</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('accountname') ? ' has-error' : '' }}">
							<input type="text" name="accountname" value="" class="form-control" required="required" onkeyup="if (/[^a-zA-Z ]/g.test(this.value)) this.value = this.value.replace(/[^a-zA-Z ]/g,'')">
							@if ($errors->has('accountname'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('accountname') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Account No</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('accountno') ? ' has-error' : '' }}">
							<input type="text" name="accountno" value="" class="form-control" required="required" onkeyup="if (/[^0-9]/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g,'')">
							@if ($errors->has('accountno'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('accountno') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>ABA No</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('abano') ? ' has-error' : '' }}">
							<input type="text" name="abano" value="" class="form-control" required="required" onkeyup="if (/[^0-9]/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g,'')">
							@if ($errors->has('abano'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('abano') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>


							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Swift Code</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('swiftcode') ? ' has-error' : '' }}">
							<input type="text" name="swiftcode" value="" class="form-control" required="required" >
							@if ($errors->has('swiftcode'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('swiftcode') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

								<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Bank Street Address</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('bankstreetaddress') ? ' has-error' : '' }}">
							<input type="text" name="bankstreetaddress" value="" class="form-control" required="required" >
							@if ($errors->has('bankstreetaddress'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('bankstreetaddress') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>

									<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>City and State/Province</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
							<input type="text" name="city" value="" class="form-control" required="required" >
							@if ($errors->has('city'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('city') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>


										<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country / Region</label>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
							<input type="text" name="country" value="" class="form-control" required="required" >
							@if ($errors->has('country'))
					                	<span class="help-block">
					                        <strong>{{ $errors->first('country') }}</strong>
					                    </span>
					                @endif
                            </div> 
							</div>
						</div>





						<input type="hidden" value="{{ $fiat }}" name="fiat">
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection