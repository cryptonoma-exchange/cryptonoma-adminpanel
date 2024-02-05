@extends('layouts.header')
@section('title', 'Liveprice List')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Liveprice List</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('/admin/addliveprice') }}" class="btn btn-info">Add</a>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Token</th>
                    <th>Price</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody> 
                @forelse($liveprice as $key => $value)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->currency }}</td>
                    <td>{{ $value->price }}</td>

                    @php

                    $token = \App\Models\Commission::where('source',$value->currency)->value('type');
                    @endphp
                    
                    @if($token == 'token')
                    <td><a href="{{ url('/admin/livepriceedit', Crypt::encrypt($value->id)) }}" class="btn btn-info">View / Edit</a></td>
                    @else
                    <td>-</td>
                    @endif
                    
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No Commissions Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $liveprice->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection