@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
<section class="content">
<div class="content__inner">
  <header class="content__title">
    <h1>KYC SECURITY SETTING</h1>
  </header>
  @if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        {{ session('status') }}
        </div>
  @endif
  <div class="card">
    <div class="card-body"> 

      @if(session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            {{ session('success') }}
            </div>
      @endif
 
      <form method="post" action="{{ url('admin/update_security') }}" autocomplete="off">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Kyc mandatory:</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">

              @if($Mobile_security)
              <select name="kyc_sec">
                <option <?php if($Mobile_security->kyc=="1") echo 'selected="selected"'; ?> value="1">Yes</option>
                <option <?php if($Mobile_security->kyc=="0") echo 'selected="selected"'; ?> value="0">No</option>
              </select>
              @else
              <select name="kyc_sec">
                <option value="">Select the type</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
              @endif
              <i class="form-group__bar"></i> </div>
                @if ($errors->has('kyc_sec'))
                  <span class="help-block">
                  <strong>{{ $errors->first('kyc_sec') }}</strong>
                  </span>
                  @endif
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-light"><i class=""></i>Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
@endsection