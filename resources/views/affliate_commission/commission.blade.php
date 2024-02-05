@extends('layouts.header')
@section('title', 'Affiliate Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Affiliate Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
           
              @if(count($commissions))
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Token</th>
                    <th>Generation</th>
                    <th>Deposit %</th>
                    <th>Trade %</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody> 
                @foreach($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->coin }}</td>
                    <td>{{ $commission->generation }}</td>
                    <td>{{ $commission->deposit }}</td>
                    <td>{{ $commission->trade }}</td>
                    <td><a href="{{ url('/admin/aff_commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-info">View / Edit</a></td>
                    
                  </tr>
                @endforeach
                </tbody>
              </table>
              {{ $commissions->links() }}
              @else
                {{ 'No Commissions Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection