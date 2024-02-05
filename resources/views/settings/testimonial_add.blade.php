@php
$atitle ="faq_add";
@endphp
@extends('layouts.header')
@section('title', 'FAQ - Admin')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Announcement Settings</h1>
    </header>

      @if ($message = Session::get('failed'))
    <div class="alert alert-danger">{{ $message }} </div><br />
  @endif

  @if (session('kycerror'))
              <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('kycerror') }}
              </div>
              @endif 
  
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ url('admin\testimonial_save') }}" enctype="multipart/form-data">
        {{ csrf_field() }} 
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Heading</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="heading" class="form-control" >

                    @if ($errors->has('heading'))
                    <span class="help-block">
                      <strong class="text text-danger">{{ $errors->first('heading') }}</strong>
                    </span>
                    @endif
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <textarea name="description" class="form-control" style="line-height: 30px;" rows=15>
                  </textarea>

                       @if ($errors->has('description'))
                    <span class="help-block">
                      <strong class="text text-danger">{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>  
             <div class="col-md-6">
                        <div class="form-group kycupload">
                          <label>Image<span class="t-red"> *</span></label>
                          <br><img id="doc1" src="" class="img-responsive">
                          <br>
<!--                          Agregue su parte frontal de identificación.
 -->                          <br>
                          <label for="file-upload1" class="custom-file-upload customupload">Upload your image here..</label>
                          <input id="file-upload1" name="front_upload_id" class="front_upload_id"  type="file" style="display:none">
                          <label id="file-name1" class="customupload1"></label><br/>
                          <span class="desc">Upload your image</span>
                          @if ($errors->has('front_upload_id'))
                    <span class="help-block">
                      <strong class="text text-danger">{{ $errors->first('front_upload_id') }}</strong>
                    </span>
                    @endif
                        </div>
                      </div>
     
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-4">
               <button class="btn btn-md btn-warning" type="submit"> Add</button><br /><br />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
  