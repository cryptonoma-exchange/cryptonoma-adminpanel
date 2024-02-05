@php
    $atitle = 'users';
@endphp
@extends('layouts.header')
@section('title', ' Users Wallet')
@section('content')

    <section class="content">
        <header class="content__title">
            <h1>User Wallet</h1>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                        <br><br>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if (session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="tab-container">

                            @include('user.menu')

                            <br>
                        </div>
                        <br>
                        <form action="{{ url('/admin/Balance_update') }}" method="POST">
                            {{ csrf_field() }}
                            @foreach ($coins as $coin)
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            @if ($coin->type != 'fiat')
                                                <label>{{ $coin->source }} Address</label>
                                            @else
                                                <label>{{ $coin->source }} Balance</label>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($coin->type != 'fiat')
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                @foreach ($coin->networks as $network)
                                                    <label for="exampleInputEmail1">{{ $network->network }}</label>
                                                    @if ($network->address != '')
                                                    <input type="text" name="from_address" class="form-control"
                                                        value="{{ $network->address }}" readonly><i
                                                        class="form-group__bar"></i>
                                                    @else
                                                        <input type="text" name="from_address" class="form-control"
                                                            value="No Address" readonly><i class="form-group__bar"></i>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if ($coin->balance > 0)
                                                @if ($coin->source == 'KES')
                                                    <input type="number" name="balance_{{ $coin->source }}"
                                                        class="form-control"
                                                        value="{{ display_format($coin->balance,2) }}"
                                                        step="0.00001" min="0" max="100000000" readonly><i
                                                        class="form-group__bar"></i>
                                                @else
                                                    <input type="number" name="balance_{{ $coin->source }}"
                                                        class="form-control"
                                                        value="{{ $coin->balance }}" step="0.00001"
                                                        min="0" max="100000000" readonly><i
                                                        class="form-group__bar"></i>
                                                @endif
                                            @else
                                                <input type="number" name="balance_{{ $coin->source }}"
                                                    class="form-control" value="0" step="0.00001" min="0"
                                                    max="100000000" readonly><i class="form-group__bar"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                        <div>
                            <h4>Add Balance:</h4>
                            <form action="{{ url('/admin/Balance_update') }}" method="POST">
                                {{ csrf_field() }}

                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Coin/Currency</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <select class="form-control" name="coin" required>
                                                <option value="">Select Coin/Currency</option>
                                                @foreach ($coins as $coin)
                                                    <option value="{{ $coin->source }}">{{ $coin->source }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('coin'))
                                                <span class="help-block error-msg">
                                                    <strong>{{ $errors->first('coin') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="number" name="amount" class="form-control" value=""
                                                required step="any" min="0" max="100000000"><i
                                                class="form-group__bar"></i>
                                            <input type="hidden" name="uid" value="{{ $userdetails->id }}">

                                            @if ($errors->has('amount'))
                                                <span class="help-block error-msg">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Reason</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="reason" class="form-control" value=""
                                                required><i class="form-group__bar"></i>
                                            @if ($errors->has('reason'))
                                                <span class="help-block error-msg">
                                                    <strong>{{ $errors->first('reason') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-success btn-xs" type="submit" name="submit" value="submit">

                            </form>
                        </div>
                        <div>
                            <h4>Reduce Balance:</h4>
                            <form action="{{ url('/admin/Balance_reduce') }}" method="POST">
                                {{ csrf_field() }}
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Coin/Currency</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <select class="form-control" name="coin" required>
                                                <option value="">Select Coin/Currency</option>
                                                @foreach ($coins as $coin)
                                                    <option value="{{ $coin->source }}">{{ $coin->source }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('coin'))
                                                <span class="help-block error-msg">
                                                    <strong>{{ $errors->first('coin') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="number" name="amount" class="form-control" value=""
                                                required step="any" min="0" max="100000000"><i
                                                class="form-group__bar"></i>
                                            <input type="hidden" name="uid" value="{{ $userdetails->id }}">

                                            @if ($errors->has('amount'))
                                                <span class="help-block error-msg">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Reason</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="reason" class="form-control" value=""
                                                required><i class="form-group__bar"></i>
                                            @if ($errors->has('reason'))
                                                <span class="help-block error-msg">
                                                    <strong>{{ $errors->first('reason') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-success btn-xs" type="submit" name="submit" value="submit">

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
