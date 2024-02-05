@php
$atitle ="bittrex";
@endphp
@extends('layouts.header')
@section('title', 'Bittrex Admin Wallet')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Admin Wallet</h1>
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
                    <th>Commission</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($coins as $coin)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $coin->source }}</td>
                    <td>{{ $coin->balance }}</td>
                  </tr>                  
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection