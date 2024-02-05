@extends('layouts.header')
@section('title', 'Add Coin Settings')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Add Token settings</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="{{ url('admin/coinlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back</a>
						<br /><br />
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
							</div>
						@endif

						@if (session('error'))
							<div class="alert alert-warning" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Failed!</strong> {{ session('error') }}
							</div>
						@endif
						<form method="post" action="{{ url('admin/addcoininsert') }}" autocomplete="off" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{-- <div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Source <span class="t-red">*</span></label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="symbol" class="form-control" value="{{ old('symbol') }}"><i
											class="form-group__bar"></i>
										@if ($errors->has('symbol'))
											<span class="help-block">
												<strong>{{ $errors->first('symbol') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div> --}}
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Type <span class="t-red">*</span></label>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label class="custom-control custom-radio">
											<input name="token_type" @if (!old('token_type') || old('token_type') == 'ERC20') checked @endif id="erc20token" type="radio"
												class="" value="ERC20">
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Erc20 Token</span>
										</label>

										<label class="custom-control custom-radio">
											<input type="radio" name="token_type" @if (old('token_type') == 'BEP20') checked @endif id="bep20token"
												class="" value="BEP20">
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Bep20 Token</span>
										</label>
										<br>
										@if ($errors->has('btn_action'))
											<span class="help-block">
												<strong>{{ $errors->first('btn_action') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>

							<div class='erc20token'>

								<div class="row" id="erc_contract">
									<div class="col-md-3">
										<div class="form-group">
											<label>Contract Address <span class="t-red">*</span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<textarea name="contractaddress" class="form-control" value="" />{{ old('contractaddress') }}</textarea><i class="form-group__bar"></i>
											@if ($errors->has('contractaddress'))
												<span class="help-block">
													<strong>{{ $errors->first('contractaddress') }}</strong>
												</span>
											@endif
										</div>
									</div>
								</div>

								{{-- <div class="row" id="erc_abi">
									<div class="col-md-3">
										<div class="form-group">
											<label>Abi Array <span class="t-red">*</span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<textarea name="abiarray" class="form-control" value="" />{{ old('abiarray') }}</textarea><i class="form-group__bar"></i>
											@if ($errors->has('abiarray'))
												<span class="help-block">
													<strong>{{ $errors->first('abiarray') }}</strong>
												</span>
											@endif
										</div>
									</div>
								</div> --}}

								{{-- <div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Point Digit <span class="t-red">*</span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="number" name="digit" min="0" max="100000" class="form-control"
												value="{{ old('digit') }}" /><i class="form-group__bar"></i>
											@if ($errors->has('digit'))
												<span class="help-block">
													<strong>{{ $errors->first('digit') }}</strong>
												</span>
											@endif
										</div>
									</div>
								</div> --}}
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Token Name <span class="t-red">*</span></label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="coinname" class="form-control" value="{{ old('coinname') }}" /><i
											class="form-group__bar"></i>
										@if ($errors->has('coinname'))
											<span class="help-block">
												<strong>{{ $errors->first('coinname') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							<input type="hidden" name="netfee" class="form-control" value="0" />

							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-8">
									<!-- <div class="loding">Loading...</div> -->
									<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
										<div class="form-group  has-feedback">
											<div class="col-xs-12 inputGroupContainer"> <img id="doc1" width="128px" height="128px"
													class="img-responsive kyc_img_cls" />
												<label for="file-upload1" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload Image
												</label>
												<input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)" name="image" type="file"
													style="display:none;">
												<label id="file-name1"></label>
												<br />
												<br />
												@if ($errors->has('image'))
													<span class="help-block"> <strong>{{ $errors->first('image') }}</strong> </span><br />
												@endif
												<p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only svg image format. Recommended image dimension 65 X 65.</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection

	@push('child-scripts')
		<script type="text/javascript">
			$(document).ready(function() {
				//called when key is pressed in textbox
				$("#price_decimal,#amount_decimal ").keypress(function(e) {
					//if the letter is not digit then display error and don't type anything
					if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						//display error message
						$("#errmsg").html("Digits Only").show().fadeOut("slow");
						return false;
					}
				});
			});
		</script>
	@endpush
