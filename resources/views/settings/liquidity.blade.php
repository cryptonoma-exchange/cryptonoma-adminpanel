@php
$atitle = 'liquidity';
@endphp
@extends('layouts.header')
@section('title', 'liquidity')
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

                        <div class="row">
                            <div class="col-md-6 tg-select-left">

                            </div>
                            <div class="col-md-6 tg-select">


                                @if (count($liquidity) == 0)
                                    <a href="{{ url('/admin/liquidityadd/') }}" class="btn btn-info pull-right">Add</a>
                                @endif


                            </div>
                        </div>
                        <div class="table-responsive search_result">
                            <table class="table" id="dows">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        {{-- <th>Date&Time</th> --}}
                                        <th>Name</th>
                                        <th>Api key</th>
                                        <th>Secret key</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($liquidity) > 0)
                                        @php
                                            $i = 1;
                                            $limit = 15;
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                                $i = $limit * $page - $limit + 1;
                                            } else {
                                                $i = 1;
                                            }
                                        @endphp
                                        @foreach ($liquidity as $admin_banks)
                                            {{-- @php$account = strlen($admin_banks->name) > 50 ? substr($admin_banks->name, 0, 50) . '...' : $admin_banks->name;
                                                                                    @endphp ?> --}}
                                            <tr>
                                                <td>{{ $i }}</td>
                                                {{-- <td>{{ date('Y/m/d h:i:s', strtotime($admin_banks->created_at)) }}</td> --}}
                                                <td>{{ $admin_banks->name }}</td>
                                                {{-- <td>{{ $admin_banks->apikey }}</td>
                                                <td>{{ $admin_banks->secretkey }}</td> --}}
                                                <td>{!!  substr(strip_tags( $admin_banks->apikey), 0, 4)!!}******************************{!!  substr(strip_tags(  $admin_banks->apikey), -4, 4)!!}</td>
                                                <td>{!!  substr(strip_tags( $admin_banks->secretkey), 0, 4)!!}******************************{!!  substr(strip_tags(  $admin_banks->secretkey), -4, 4)!!}</td>
                                                
                                                <td><a class="btn btn-success btn-xs"
                                                        href="{{ url('/admin/liquidityedit/' . Crypt::encrypt($admin_banks->id) . '/') }}"><i
                                                            class="zmdi zmdi-edit"></i> Update </a> </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7"> No record found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
