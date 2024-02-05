
@extends('layouts.header')
@section('title', 'Coins Setting')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Tokens</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
                    <a href="{{ url('/admin/addcoin') }}" class="btn btn-info">Add Token</a>

              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Token Symbol</th>
                    <th>Network</th>
                    <th>Token Name</th>
                    <th>Contract Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                @forelse($networks as $network)
                  <tr>
                    <td>{{ $loop->index + $networks->firstItem() }}</td>
                    <td>{{ $network->coin->source }}</td>
                    <td>{{ $network->network }}</td>
                    <td>{{ $network->coin->coinname }}</td>
                    <td>{{ $network->contractaddress }}</td>                    
                    <td><a href="{{ url('/admin/coinsettings', Crypt::encrypt($network->id)) }}" class="btn btn-info">View / Edit</a></td>
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No List Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $networks->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection