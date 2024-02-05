@php
$atitle = 'Coldwalletaddress';
@endphp
@extends('layouts.header')
@section('title', 'Coldwalletaddress')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Cold wallet address</h1>
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


                             
                                    {{-- <a href="{{ url('/admin/addcoldwalletaddress/') }}" class="btn btn-info pull-right">Add</a> --}}
                              

                            </div>
                        </div>
                        <div class="table-responsive search_result">
                            {{-- <table class="table" id="dows">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>btc</th>
                                        <th>bnb</th>
                                        <th>ltc</th>
                                        <th>xrp</th>
                                        <th>bch</th>
                                        <th>eth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($coldwallet) > 0)
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
                                        @foreach ($coldwallet as $coldwallets)

                                        @php $account = strlen($coldwallets->id) > 20 ? substr($coldwallets->btc_address,0,20)."..." :$coldwallets->id;
                                        @endphp
                                           
                                            <tr>
                                                <td>{{ $coldwallets->id }}</td>
                                                {{-- <td>{{ $coldwallets->btc_address }}</td> --}}
                                                {{-- <td>{!!  substr(strip_tags( $coldwallets->btc_address), 0, 10) !!}</td>
                                                <td>{!!  substr(strip_tags( $coldwallets->bnb_address), 0, 10) !!}</td>
                                                <td>{!!  substr(strip_tags( $coldwallets->ltc_address), 0, 10) !!}</td>
                                                <td>{!!  substr(strip_tags( $coldwallets->xrp_address), 0, 10) !!}</td>
                                                <td>{!!  substr(strip_tags( $coldwallets->bch_address), 0, 10) !!}</td>
                                                <td>{!!  substr(strip_tags( $coldwallets->eth_address), 0, 10) !!}</td> --}}
                                                {{-- <td><a class="btn btn-success btn-xs"
                                                        href="{{ url('/admin/coldwalletaddress/edit/' . Crypt::encrypt($coldwallets->id) . '/') }}"><i
                                                            class="zmdi zmdi-edit"></i> Update </a> </td>
                                                <td><a class="btn btn-success btn-xs"
                                                    href="{{ url('/admin/coldwalletaddressdelete/' . Crypt::encrypt($coldwallets->id) . '/') }}"><i
                                                        class="zmdi zmdi-edit"></i> Delete </a> </td> --}}
                                            {{-- </tr>
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
                            </table>  --}}

        <div class="card">
            @foreach ($coldwallet as $coldwallets)
            @php $account = strlen($coldwallets->id) > 20 ? substr($coldwallets->btc_address,0,4)."..." :$coldwallets->id;
            @endphp
      <div class="card-body">
        {{-- <a href="{{ url('/admin/addcoldwalletaddress/') }}" class="btn btn-info pull-right">Add</a> --}}
        <br />
        <br />
        
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>BTC</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{-- <input type="text" name="btc_address" class="form-control" value="{{ $coldwallets->btc_address }}" readonly> --}}
                <input type="text" name="btc_address" class="form-control" value="{!!  substr(strip_tags( $coldwallets->btc_address), 0, 4)!!}******************************{!!  substr(strip_tags( $coldwallets->btc_address), -4, 4)!!}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>BNB</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{-- <input type="text" name="bnb_address" class="form-control" value="{{ $coldwallets->bnb_address }}" readonly> --}}
                <input type="text" name="bnb_address" class="form-control" value="{!!  substr(strip_tags( $coldwallets->bnb_address), 0, 4)!!}******************************{!!  substr(strip_tags( $coldwallets->bnb_address), -4, 4)!!}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>LTC</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{-- <input type="text" name="ltc_address" class="form-control" value="{{ $coldwallets->ltc_address }}" readonly> --}}
                <input type="text" name="ltc_address" class="form-control" value="{!!  substr(strip_tags( $coldwallets->ltc_address), 0, 4)!!}******************************{!!  substr(strip_tags( $coldwallets->ltc_address), -4, 4)!!}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>XRP</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{-- <input type="text" name="xrp_address" class="form-control" value="{{ $coldwallets->xrp_address }}" readonly> --}}
                <input type="text" name="xrp_address" class="form-control" value="{!!  substr(strip_tags( $coldwallets->xrp_address), 0, 4)!!}******************************{!!  substr(strip_tags( $coldwallets->xrp_address), -4, 4)!!}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>BCH</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{-- <input type="text" name="bch_address" class="form-control" value="{{ $coldwallets->bch_address }}" readonly> --}}
                <input type="text" name="bch_address" class="form-control" value="{!!  substr(strip_tags( $coldwallets->bch_address), 0, 4)!!}******************************{!!  substr(strip_tags( $coldwallets->bch_address), -4, 4)!!}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ETH</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{-- <input type="text" name="fromaddress" class="form-control" value="{{ $coldwallets->eth_address }}" readonly> --}}
                <input type="text" name="eth_address" class="form-control" value="{!!  substr(strip_tags( $coldwallets->eth_address), 0, 4)!!}******************************{!!  substr(strip_tags( $coldwallets->eth_address), -4, 4)!!}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
       
      </div>
      @endforeach
    </div>


                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
