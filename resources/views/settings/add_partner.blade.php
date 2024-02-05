@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'Add Partner Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Add Partner Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/partner') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Partner</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/update_partner') }}" autocomplete="off" enctype="multipart/form-data">
						{{ csrf_field() }}
						
							<div class="row">
							<div class="col-xs-8 col-sm-8 col-md-8">
								<!-- <div class="loding">Loading...</div> -->
								<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
									<div class="form-group  has-feedback">
										<div class="col-xs-12 inputGroupContainer"> <img id="doc1" width="128px"  height="128px" class="img-responsive kyc_img_cls" />
											<label for="file-upload1" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload Image </label>
											<input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)" name="image" type="file" style="display:none;">
											<label id="file-name1"></label>
											<br/>
											<br/>
											@if ($errors->has('image')) <span class="help-block"> <strong>{{ $errors->first('image') }}</strong> </span><br/> @endif 
										<!-- 	<p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png image format 128 X 128</p> -->
										</div>
									</div>							
								</div>
							</div>
						</div>



						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection

