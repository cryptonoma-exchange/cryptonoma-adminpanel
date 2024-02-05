@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'Partner logo')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Partner page logo Update</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    
            <div class="table-responsive">
            	<a href="{{ url('/admin/addpartner') }}" class="btn btn-info">Add Partner</a>
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Logo image</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody> 
                @forelse($partner as $key => $val)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td><img style="width: 14%;" src="https://vrsx.net/images/partners/{{ $val->image }}"></td>
                    <td><a href="{{ url('/admin/partner_remove', Crypt::encrypt($val->id)) }}" class="btn btn-info">Delete</a></td>
                    
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No records found!' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $partner->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection