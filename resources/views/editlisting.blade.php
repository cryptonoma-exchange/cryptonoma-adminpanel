@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Listing Application Settings</h1>
	</header>
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/listing') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Listing</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                    @if(session('statuserror'))
                        <div class="alert alert-danger	" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failure!</strong> {{ session('statuserror') }}
                        </div>
                    @endif

                    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
					<form method="post" action="" autocomplete="off">
						{{ csrf_field() }}
					
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Name of the issuer</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->name}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


								<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Email</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->email}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


									<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->coinname}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


									<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin short name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->coinshortname}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Total Supply</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->totalsupply}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


									<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Current Circulations</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->circulation}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>						


										<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Website</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->website}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


											<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Github source</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->github}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

												<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Contract address (For BEP-20, CER-20 and TRC-20 tokens)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->contractaddress}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


													<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Block Explorer</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->blockexplorer}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

														<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin Type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->cointype}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

															<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Telegram</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->telegram}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


																<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Twitter</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->twitter}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>



																<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Facebook</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->facebook}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

							
																<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Message</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->message}}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
	
	







				
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection