@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Leverages Commission Settings</h1>
    </header>
  
    <div class="row">
    
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

                @if(session('remove_status'))
                <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('remove_status') }}
                </div>
                @endif


            <div class="table-responsive">
               <a href="{{ url('admin/leverage_add_view') }} " class="btn btn-info">Add</a>
              </br>
              @if(count($commissions))
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Commission</th>
                    <th>View</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody> 
                @foreach($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->title }}</td>
                    <td>{{ $commission->value }}</td>
                    <td>{{ $commission->commission }}</td>
                    <td><a href="{{ url('/admin/leverage_commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-info">View / Edit</a>
                     <td><a href="{{ url('/admin/leverage_delete', Crypt::encrypt($commission->id)) }}" class="btn btn-info">Delete</a></td>
                    
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