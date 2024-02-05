@extends('layouts.header')
@section('title', 'Admin Wallet')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Admin Wallet</h1>
    </header>
    @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/adminwallet') }}"><i class="zmdi zmdi-arrow-left"></i> Back to admin wallet</a>
        <br />
        <br />
        <form method="POST" action="{{ url('admin/walletupdate') }}" id="theform">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Coin / Currency /Token</label>
              </div>
            </div>
            <div class="col-md-4">

              <input type="hidden" name="id" class="form-control" value="{{ Crypt::encrypt($result->id) }}" readonly>

              <div class="form-group">
                <input type="text" name="coinname" class="form-control" value="{{ $result->asset }}" readonly>
                <i class="form-group__bar"></i> </div>
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
                <input type="text" name="address" class="form-control" value="{{ $result->address }}">
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Balance</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="balance" class="form-control" value="{{ $result->balance }}" readonly="">
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
         
           <div class="form-group">
              <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>
  @endsection
  