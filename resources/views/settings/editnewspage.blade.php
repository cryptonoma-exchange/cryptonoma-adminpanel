@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'Update News Page List')
@section('content')
<section class="content">
  <header class="content__title">
    <h1>Update News Page List</h1>
  </header>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <a href="{{ url('admin/news') }}"><i class="zmdi zmdi-arrow-left"></i> Back to News</a>
            <br /><br />
          @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                    @if(session('statuserror'))
                        <div class="alert alert-danger  " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('statuserror') }}
                        </div>
                    @endif
  
          <form method="post" action="{{ url('admin/updatenews') }}" autocomplete="off" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $news->id }}" name="id">


            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>News Title</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="title" class="form-control" value="{{ $news->title != NULL ? $news->title : ' - ' }}" /><i class="form-group__bar"></i>
              @if ($errors->has('title'))
                  <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                  </span>
                  @endif
                 
                </div>
               
              </div>
            </div>


             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>News Description</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea rows="4" cols="50" name="desc" class="form-control ckeditor">{{ $news->desc != NULL ? $news->desc : ' - ' }}</textarea>
                @if ($errors->has('desc'))
                  <span class="help-block">
                  <strong>{{ $errors->first('desc') }}</strong>
                  </span>
                  @endif
                  
                </div>
              
              </div>
            </div>


             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>News Image</label>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">

                  <img id="doc11"  style="width:100px;" class="img-responsive frontig selfi" name="img" src="{{ \Config::get('app.siteurl').$news->img }}">
                <br/> 
                   <label for="file-upload11" class="custom-file-upload">
                  <i class="fa fa-cloud-upload"></i> Upload File </label>
                  <input id="file-upload11" name="upload_cont_img" type="file" style="display:none;">
                  <label id="file-name11" class="customupload1"></label><br/>
                </div>
                 @if ($errors->has('upload_cont_img'))
                  <span class="help-block">
                  <strong>{{ $errors->first('upload_cont_img') }}</strong>
                  </span>
                  @endif
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