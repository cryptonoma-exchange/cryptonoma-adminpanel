@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'Features Settings - Admin')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Statistics</h1>
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
        <form method="POST" action="{{ url('admin\statistics_update') }}">
        {{ csrf_field() }}

       

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Statistics One Data</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="statisticsone_data" class="form-control" value="{{ $featurestext['statisticsone_data'] }}">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Statistics One Number</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="statisticsone_number" class="form-control" value="{{ $featurestext['statisticsone_number'] }}">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Statistics Two Data</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="statisticstwo_data" class="form-control" value="{{ $featurestext['statisticstwo_data'] }}">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Statistics Two Number</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="statisticstwo_number" class="form-control" value="{{ $featurestext['statisticstwo_number'] }}">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Statistics Three Data</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="statisticsthree_data" class="form-control" value="{{ $featurestext['statisticsthree_data'] }}">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Statistics Three Number</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="statisticsthree_number" class="form-control" value="{{ $featurestext['statisticsthree_number'] }}">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

          {{-- @foreach($features as $key => $new)
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Heading</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="heading[]" class="form-control" value="{{ $new->heading }}">
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="description[]" class="form-control" value="{{ $new->desc }}" >
                  <i class="form-group__bar"></i> </div>
              </div>
            </div> 
          @endforeach --}}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <button class="btn btn-md btn-warning" type="submit"> Update</button>
              </div>
            </div>
            <div class="col-md-4">
               
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
  @endsection
  