@php
$atitle = 'adminbank';
@endphp
@extends('layouts.header')
@section('title', 'Add bank')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Add Details</h1>
        </header>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/liquidity/') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Liquidity
                            Details</a>
                        <br /><br />
                        <form method="post" action="{{ url('admin/addliq') }}" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="row">


                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                        <input type="text" name="name" value="" class="form-control" required="required"
                                            onkeyup="if (/[^a-zA-Z ]/g.test(this.value)) this.value = this.value.replace(/[^a-zA-Z ]/g,'')">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Api Key</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('apikey') ? ' has-error' : '' }}">

                                        <input type="text" name="apikey" value="" class="form-control"
                                            required="required">
                                        @if ($errors->has('apikey'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('apikey') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Secret Key</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('secretkey') ? ' has-error' : '' }}">
                                        <input type="text" name="secretkey" value="" class="form-control"
                                            required="required">
                                        @if ($errors->has('secretkey'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('secretkey') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" name="edit" class="btn btn-light"><i class=""></i>
                                    Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
