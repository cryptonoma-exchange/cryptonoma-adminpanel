@php
$atitle ="settings";
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
<section class="content">
<div class="content__inner">
  <header class="content__title">
    <h1>SECURITY SETTING</h1>
  </header>
  @if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        {{ session('status') }}
        </div>
  @endif
    @if(session('disabledsuccess'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        {{ session('disabledsuccess') }}
        </div>
  @endif
  <div class="card">
    <div class="card-body"> 
  <form method="post" action="{{ url('admin/changeusername') }}" autocomplete="off">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Admin Email</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="email" required="required"  id="email" class="form-control" value="{{ $adminemail }}">
              <i class="form-group__bar"></i> </div>

                          @if ($errors->has('email'))
                          <span class="help-block">
                            <strong class="text text-danger">{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                          
          </div>
        </div>
         <div class="row" hidden>
          <div class="col-md-3">
            <div class="form-group">
              <label>Notify Email</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="notify_mail1" required="required"  id="notify_mail1" class="form-control" value="{{ $admin_data->notify_mail1 }}">
              <i class="form-group__bar"></i> </div>

                          @if ($errors->has('notify_mail1'))
                          <span class="help-block">
                            <strong class="text text-danger">{{ $errors->first('notify_mail1') }}</strong>
                          </span>
                          @endif
                          
          </div>
        </div>

         <div class="row" hidden>
          <div class="col-md-3">
            <div class="form-group">
              <label>Notify Email</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="notify_mail2" required="required"  id="notify_mail2" class="form-control" value="{{ $admin_data->notify_mail2 }}">
              <i class="form-group__bar"></i> </div>

                          @if ($errors->has('notify_mail2'))
                          <span class="help-block">
                            <strong class="text text-danger">{{ $errors->first('notify_mail2') }}</strong>
                          </span>
                          @endif
                          
          </div>
        </div>

    
        <div class="form-group">
          <button type="submit" name="save" class="btn btn-light"><i class=""></i> Save</button>
        </div>
      </form> 
      @if(session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            {{ session('success') }}
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
      <form method="post" action="{{ url('admin/changepassword') }}" autocomplete="off">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Current Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="password" name="currentpassword" required="required" placeholder="Old Password" id="site_title" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>New Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="password" name="password" required="required" placeholder="New Password" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Confirm New Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group"> <span id="amount"></span>
              <input type="password" name="password_confirmation" required="required"  class="form-control" placeholder="Confirm Password" 
								value="" >
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <input type="hidden" name="token" class="form-control" value="" placeholder="">
        <div class="form-group">
          <button type="submit" name="change_password" class="btn btn-light"><i class=""></i> Change Password</button>
        </div>
      </form>
          <div class="securityset">                   
    <div class="sectable">
      <div><h1 class="h1"><i class="fa fa-qrcode"></i> Authentication</h1>
      <h5 class="h5 t-gray">2FA Code will be generated by your smart phone app</h5></div>
        @if(!$admin_data->google2fa_verify) 
      <div class="verifybtnbg"><a href="{{ url('admin/adminEnabletwofa') }}" class="btn btn-light">Enable</a></div>
        @else
           @if($admin_data->google2fa_secret)
          <div class="verifybtnbg"><a href="{{ url('admin/adminDisabletwofa') }}" class="btn btn-light">Disable</a></div>

            @endif
                            @endif
    </div>                          
  </div>
    </div>
  </div>
</div>
</section>






@endsection