@php
$atitle ="kycview";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Income certificate Submits</h1>
    </header>
    @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/incomecer') }}"><i class="zmdi zmdi-arrow-left"></i> Back to list</a>
        <br />
        <br />
        <form method="POST" action="{{ url('admin/incomekycupdate') }}" id="theform">
        {{ csrf_field() }}
          
      
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Income certificate Proof</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->income_img }}"><img width="200px" src="{{ $kyc->income_img }}"></a></div>
            </div>
          </div>

    
          
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                @if($kyc->income_status == 0 || $kyc->income_status == 3) 
                  <select class="form-control" name="status">
                    <option value="0">Waiting</option>
                    <option value="1">Accepted</option>
                    <option value="3">Rejected</option>
                  </select> 
              @else
                 @if($kyc->income_status == 1)
                    Accepted
                  @elseif($kyc->income_status == 3)
                    Rejected
                 @else
                    Waiting
                 @endif
              @endif
              </div>
            </div>
          </div>

    
          @if(in_array("write", explode(',',$AdminProfiledetails->kyc)))
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            @if($kyc->income_status == 0 || $kyc->income_status == 3)
            <div class="col-md-4">
               <input type="hidden" name="kyc_id" value="{{ $kyc->kyc_id }}"/>
               <input type="hidden" name="uid" value="{{ $kyc->uid }}"/>
               <input type="submit" class="btn btn-md btn-warning" value="Update"> <br /><br />
               <p>Note : Once you accept / reject proof, You can't update the status again!</p>
            </div>
            @endif
          </div>
          @endif
        </form>
      </div>
    </div>
  </div>
</section>
  @endsection
  