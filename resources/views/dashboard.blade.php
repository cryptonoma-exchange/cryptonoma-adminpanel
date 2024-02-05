@php
$atitle = 'dashboard';
$AdminProfiledetails = $details['AdminProfiledetails'];
@endphp
@extends('layouts.header', $details)
@section('title', 'Admin Dashboard')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Dashboard</h1>
        </header>
        <form action="{{ url('/admin/userssearch') }}" method="post" autocomplete="off">
            {{ csrf_field() }}
            <div class="row searchnrow">

                <div class="col-md-3">
                    <input type="text" name="statdate" class="form-control date-picker"
                        value="@if (isset($details['statdate'])) {{ $details['statdate'] }} @endif" placeholder="Start Date"
                        required="" />
                </div>

                <div class="col-md-2">
                    <input type="text" name="enddate" class="form-control date-picker"
                        value="@if (isset($details['enddate'])) {{ $details['enddate'] }} @endif" placeholder="End Date"
                        required="" />
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success user_date"><i class="fa fa-search"></i> Search</button>
                    <a class="btn btn-warning btn-xs" href="{{ url('/admin/dashboard') }}"> <i class="fa fa-refresh"></i>
                        Clear </a>
                </div>
            </div>
        </form>
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>
        @endif
        <div class="row quick-stats listview2">

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['totalusers'] }}</h2>
                        <small>Total Users</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['kycverify'] }}</h2>
                        <small>KYC Verified Users</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['completebuytrade'] }}</h2>
                        <small>Completed buy Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-exchange"></i></h1>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['completeselltrade'] }}</h2>
                        <small>Completed Sell Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-exchange"></i></h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['chat'] }}</h2>
                        <small>Unread Support Tickets</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['blockusers'] }}</h2>
                        <small>Blockuser</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-exchange"></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['buytrade'] }}</h2>
                        <small>Pending Buy Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-shopping-cart" aria-hidden="true"></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2>{{ $details['selltrade'] }}</h2>
                        <small>Pending Sell Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-shopping-bag" aria-hidden="true"></i></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Site Statistics</h4>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-users"></i></div>
                                <div class="widget-past-days__info"><small>Total Users</small>
                                    <h3><a href="/admin/users">{{ $details['totalusers'] }}</a></h3>
                                </div>

                            </div>
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="zmdi zmdi-assignment-o"></i></div>
                                <div class="widget-past-days__info"><small>KYC Verified Users</small>
                                    <h3><a href="/admin/kyc">{{ $details['kycverify'] }}</a></h3>
                                </div>

                            </div>
                        </div>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="zmdi zmdi-ticket-star"></i></div>
                                <div class="widget-past-days__info"><small>Unread Support Tickets</small>
                                    <h3><a href="/admin/support">{{ $details['chat'] }}</a></h3>
                                </div>

                            </div>

                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="zmdi zmdi-block-alt zmdi-hc-fw"></i></div>
                                <div class="widget-past-days__info"><small>Blockuser</small>
                                    <h3><a href="/admin/users">{{ $details['blockusers'] }}</a></h3>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Trade Statistics</h4>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-exchange"></i></div>
                                <div class="widget-past-days__info"><small>Completed Trade</small>
                                    <h3><a href="/admin/buy_tradehistory/BTC_KES/limit">
                                            {{ $details['completedtrade'] }}</a></h3>
                                </div>
                            </div>
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-exchange"></i></div>
                                <div class="widget-past-days__info"><small>Total Earnings</small>
                                    <h3><a href="/admin/deposits/KES">0</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-shopping-cart"></i></div>
                                <div class="widget-past-days__info"><small>Pending Buy Trade</small>
                                    <h3><a href="/admin/pending_tradehistory/all/Buy">{{ $details['buytrade'] }}</a>
                                    </h3>
                                </div>
                            </div>

                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-shopping-bag"></i></div>
                                <div class="widget-past-days__info"><small>Pending Sell Trade</small>
                                    <h3><a href="/admin/pending_tradehistory/all/Sell">{{ $details['selltrade'] }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if (in_array('kyc_view', explode(',', $AdminProfiledetails->dashboard)))

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent KYC Submit Users (Pending)</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Date & Time</th>
                                            <th>Username</th>
                                            <th>Kyc Verify</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($details['kyc_users'] as $kyc_users_data)
                                            <tr>
                                                <td>{{ date('m-d-Y H:i:s', strtotime($kyc_users_data->created_at)) }}
                                                </td>
                                                <td>{{ username($kyc_users_data->uid) }}</td>
                                                <td>Awaiting Confirmation </td>

                                                <td><a class="btn btn-success btn-xs"
                                                        href="{{ url('admin/kycview/' . Crypt::encrypt($kyc_users_data->kyc_id)) }}"><i
                                                            class="zmdi zmdi-edit"></i> View </a> </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6"> No Record Found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                @if (in_array('withdraw_view', explode(',', $AdminProfiledetails->dashboard)))

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Withdraw Request (Pending)</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Username</th>
                                            <th>Coin/Token</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($details['withdraw_request']))
                                            @foreach ($details['withdraw_request'] as $withdraw_requests)
                                                <tr>
                                                    <td>{{ date('m-d-Y H:i:s', strtotime($withdraw_requests->created_at)) }}
                                                    </td>
                                                    <td>{{ $withdraw_requests->user->name }}</td>
                                                    <td>{{ $withdraw_requests->currency }}</td>
                                                    <td>{{ $withdraw_requests->paymenttype ? $withdraw_requests->paymenttype : "-" }}</td>
                                                    <td>{{ display_format($withdraw_requests->amount, 8, '.', '') }}</td>
                                                    <td>Awaiting Confirmation </td>
                                                    <td>
                                                        <a class="btn btn-success btn-xs" href="{{ $withdraw_requests->view_link }}">
                                                        <i class="zmdi zmdi-edit"></i> 
                                                        View 
                                                        </a> 
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"> No Record Found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                @if (in_array('support_view', explode(',', $AdminProfiledetails->dashboard)))
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Support Ticket</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Username</th>
                                            <th>Ticket Id</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            @if (in_array('write', explode(',', $AdminProfiledetails->support)))
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($details['support_ticket']))
                                            @foreach ($details['support_ticket'] as $support_tickets)
                                                <tr>
                                                    <td>{{ date('m-d-Y H:i:s', strtotime($support_tickets->created_at)) }}
                                                    </td>
                                                    <td>{{ username($support_tickets->uid) }}</td>
                                                    <td>{{ $support_tickets->ticket_id }}</td>
                                                    <td>{{ $support_tickets->subject }}</td>
                                                    <td>{{ $support_tickets->message }}</td>
                                                    @if (in_array('write', explode(',', $AdminProfiledetails->support)))
                                                        <td><a class="btn btn-success btn-xs"
                                                                href="{{ url('/admin/reply/' . Crypt::encrypt($support_tickets->ticket_id)) }}"><i
                                                                    class="zmdi zmdi-edit"></i> View </a> </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"> No Record Found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Deposit Request (Pending)</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Username</th>
                                    <th>Coin/Token</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($details['deposit_request']))
                                    @foreach ($details['deposit_request'] as $withdraw_requests)
                                        <tr>
                                            <td>{{ date('m-d-Y H:i:s', strtotime($withdraw_requests->created_at)) }}</td>
                                            <td>{{ $withdraw_requests->user->name }}</td>
                                            <td>{{ $withdraw_requests->currency }}</td>
                                            <td>{{ $withdraw_requests->paymenttype }}</td>
                                            <td>{{ display_format($withdraw_requests->amount, 2, '.', '') }}</td>
                                            <td>Awaiting Confirmation </td>
                                            @if (in_array('write', explode(',', $AdminProfiledetails->withdrawlist)))
                                                {{-- <td><a class="btn btn-success btn-xs"
                                                        href="{{ url('/admin/crypto_withdraw_edit' . '/' . Crypt::encrypt($withdraw_requests->id)) }}">
                                                        <i class="zmdi zmdi-edit"></i> View </a> </td> --}}
                                                        
                                                        <td><a class="btn btn-success btn-xs"
                                                            href="{{ url('/admin/fiatdeposit_edit' . '/' . Crypt::encrypt($withdraw_requests->id)) }}">
                                                            <i class="zmdi zmdi-edit"></i> View </a> </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"> No Record Found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection