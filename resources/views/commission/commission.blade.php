@php
$atitle ="commission";
@endphp
@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <th>Name</th>
                    <th>Withdraw %</th>
                    <th>Trade Buy %</th>
                    <th>Trade Sell %</th>
                    <th>Minimum Unit Price</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody> 
                @forelse($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->source }}</td>
                    <td>{{ $commission->coinname }}</td>
                    <td>{{ $commission->withdraw }}</td>
                    <td>{{ $commission->buy_trade }}</td>
                    <td>{{ $commission->sell_trade }}</td>
                    <td>{{ number_format($commission->min_trade_price, $commission->decimal) }}</td>
                    <td><a href="{{ url('/admin/commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-info">View / Edit</a></td>
                    
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No Commissions Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $commissions->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection