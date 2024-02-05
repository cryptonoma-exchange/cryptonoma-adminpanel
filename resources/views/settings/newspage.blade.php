@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'News Page List')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>News Page List</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

                      @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                    @if(session('statuserror'))
                        <div class="alert alert-danger  " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('statuserror') }}
                        </div>
                    @endif

            <a href="{{ url('/admin/newsadd') }}" class="btn btn-info">Add</a>        

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody> 
                @forelse($banner as $key => $value)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->title }}</td>
                    <td><a href="{{ url('/admin/newsedit', Crypt::encrypt($value->id)) }}" class="btn btn-info">View / Edit</a></td> 
                     <td><a href="{{ url('/admin/newsdelete', Crypt::encrypt($value->id)) }}" class="btn btn-info">Remove</a></td>

                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No Commissions Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $banner->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection