@extends('layouts.header')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>SCAN QR CODE ON YOUR MOBILE</h1>
    </header>
        @if(session('disabledsuccess'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        {{ session('disabledsuccess') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        {{ session('error') }}
        </div>
        @endif
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ url('admin/security') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Security</a>
        <br /><br />
        <h5>Install Google Authenticator app in Your mobile and scan QR code in google verification code</h5><br />
        <div class="kyc-box ">
          <div class="text-center split-box col-xs-12">
            <div class="">
              <div class="grey-box ">
                <div>
                  <h4>Google 2FA Verification QR </h4>
                  <br />
                  <a href="{{ $image }}" download class="dowlt"> </a>
                  <br /><br />
                  <img class="qr-code-pic" src="{{ $image }}">
                </div><br />
                <h4>Google 2FA SecretCode : {{ $secret }}</h4>
                <div class="text-center center-class">
                <div class="col-md-12">                
                @if(session('activatedstatus'))
                <div class="alert alert-success"><i class="fa fa-check"></i>
                  {{ session('activatedstatus') }}
                </div>
                @endif
                @if(session('status'))
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {{ session('status') }}
                </div>
                @endif
                <br />
                <form action="{{ url('admin/verifyTwoFaCode') }}" method="POST" autocomplete="off">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback">
                    <label class="col-xs-12 control-label">Enter your authentication code</label>
                    <input type="hidden" name="secret" value="{{ $secret }}">
                    <div class="col-xs-12 inputGroupContainer">
                      <input required="" name="google_code" onkeyup="if (/[^0-9]/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g,'')" class="form-control allownumericwithdecimal text-center" type="text">
                    </div>
                  </div>
                  <div class="text-center form-group">        
                    <button type="submit" class="btn btn-success site-btn mt-20 text-uppercase nova-font-bold">Submit</button>
                  </div>
                </form>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection