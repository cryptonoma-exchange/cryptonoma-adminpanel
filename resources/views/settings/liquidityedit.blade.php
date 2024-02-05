@php
$atitle = 'adminbank';
@endphp
@extends('layouts.header')
@section('title', 'Edit bank')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Liquidity Details</h1>
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
                        <form method="post" action="{{ url('admin/updateliq') }}" autocomplete="off">
                            {{ csrf_field() }}



                            <input type="hidden" name="id" value="{{ $liquidity->id }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <input type="text" name="name" value="{{ $liquidity->name }}"
                                            class="form-control" required="required"
                                            onkeyup="if (/[^a-zA-Z ]/g.test(this.value)) this.value = this.value.replace(/[^a-zA-Z ]/g,'')"
                                            value=''>
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
                                        <label>Api key</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('apikey') ? ' has-error' : '' }}">
                                        <input type="text" name="apikey" value="{{ $liquidity->apikey }}"
                                            class="form-control" required="required" value=''>
                                        @if ($errors->has('account_no'))
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
                                        <input type="text" name="secretkey" value="{{ $liquidity->secretkey }}"
                                            class="form-control" required="required" value=''>
                                        @if ($errors->has('secretkey'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('secretkey') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Testnet</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('testnet') ? ' has-error' : '' }}">
                                        <select name="testnet" class="form-control">
                                            <option value="0" @if($liquidity->testnet == 0) selected @endif>Disabled</option>
                                            <option value="1" @if($liquidity->testnet == 1) selected @endif>Enabled</option>
                                        </select>
                                        @if ($errors->has('testnet'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('testnet') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="edit" class="btn btn-light"><i class=""></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
