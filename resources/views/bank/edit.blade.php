@php
$atitle = 'adminbank';
@endphp
@extends('layouts.header')
@section('title', 'Admin Bank')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Mpesa Details</h1>
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
                        <a href="{{ url('admin/mpesa/') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Mpesa Details</a>
                        <br /><br />

                        <div class="row">
                            <div class="col-12 tg-select">


                                {{-- @if (count($mpesa) == 0)
			<a href="{{ url('addmpesa') }}" class="btn btn-info pull-right">Add</a>
			@endif --}}

                                <form action="{{ url('admin/mpesa/update', $mpesa->id) }}" method="post">
                                    @csrf
                                    {{-- <p>passkey:<input type="text" name="studentname" value="{{$mpesa->passkey}}"></p></br>
				<p>shortcode:<input type="number" name="tamil" value="{{$mpesa->shortcode}}"></p></br>
				 <button class="btn btn-success btn-xs" type="submit" name="submit" value="submit">submit:</button> --}}
                                    {{-- <a class="btn btn-success btn-xs" href="{{ url('mpesa/edit/') }}"><i class="zmdi zmdi-edit"></i> Update </a> --}}


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>APIkey</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('Passkey') ? ' has-error' : '' }}">
                                                <input type="text" name="passkey" value="{{ $mpesa->passkey }}"
                                                    class="form-control" required="required">
                                                @if ($errors->has('passkey'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('passkey') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Shortcode</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('shortcode') ? ' has-error' : '' }}">
                                                <input type="text" name="shortcode" value="{{ $mpesa->shortcode }}"
                                                    class="form-control" required="required">
                                                @if ($errors->has('shortcode'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('shortcode') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-light"><i
                                                class=""></i> Submit</button>
                                    </div>

                                </form>


                            </div>
                        </div>
                        <div class="table-responsive search_result">

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </section>
@endsection
