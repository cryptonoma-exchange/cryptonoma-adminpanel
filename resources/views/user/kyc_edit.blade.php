@php
$atitle ="kycview";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>KYC Submits</h1>
    </header>
    @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/kyc') }}"><i class="zmdi zmdi-arrow-left"></i> Back to KYC Submit</a>
        <br />
        <br />
        <form method="POST" action="{{ url('admin/kycupdate') }}" id="theform">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>First Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->fname }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Last Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->lname }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Date of Birth</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->dob }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>State/City</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->city }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Country</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->country }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nationality</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->nationality }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

        

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Zip Code</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="zipcode" class="form-control" value="{{ $kyc-> zipcode ? $kyc->  zipcode :'-' }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div> -->

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Address</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="address" class="form-control" value="{{ $kyc->address ? $kyc->address :'-' }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Type</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->id_type == "Driving Licence" ? "Driver's Licence" : $kyc->id_type }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

     @if($kyc->id_type =='Other')
           <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Other Type</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
        
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->other_type }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          @endif

            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Document Number</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->id_number }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          @if ($kyc->id_type != "National ID")
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Expiry Date</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="{{ $kyc->id_exp  }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div> 
          @endif
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Front Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->front_img }}"><img width="200px" src="{{ $kyc->front_img }}"></a> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Back Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->back_img }}"><img width="200px" src="{{ $kyc->back_img }}"></a></div>
            </div>
          </div>

              {{-- <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Personal Tax Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->address_img }}"><img width="200px" src="{{ $kyc->address_img }}"></a></div>
            </div>
          </div> --}}


             <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Address Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->proofpaper }}"><img width="200px" src="{{ $kyc->proofpaper }}"></a></div>
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
                @if($kyc->status == 0) 
                  <select class="form-control" name="status">
                    <option value="0">Waiting</option>
                    <option value="1">Accepted</option>
                    <option value="2">Rejected</option>
                  </select> 
              @else
                 @if($kyc->status == 1)
                    Accepted
                 @else
                    Rejected
                 @endif
              @endif
              </div>
            </div>
          </div>

              <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Remark</label>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                @if($kyc->status == 2)
                <textarea type="text" name="remark" class="form-control">{{ $kyc->remark ? $kyc->remark :' ' }}</textarea>
                @else
                   <textarea type="text" name="remark" class="form-control">{{ $kyc->remark ? $kyc->remark :' ' }}</textarea>
                @endif
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          @if(in_array("write", explode(',',$AdminProfiledetails->kyc)))
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            @if($kyc->status == 0)
            <div class="col-md-4">
               <input type="hidden" name="kyc_id" value="{{ $kyc->kyc_id }}"/>
               <input type="hidden" name="uid" value="{{ $kyc->uid }}"/>
               <input type="submit" class="btn btn-md btn-warning" value="Update"> <br /><br />
               <p style="color:black;">Note : Once you accept / reject kyc, You can't update the status again!</p>
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
  