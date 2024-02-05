@php
$atitle ="tradepair";
@endphp
@extends('layouts.header')
@section('title', 'Trade pair Setting')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Trade pairs</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
                   
               <a href="{{ url('/admin/addpair') }}" class="btn btn-info">Add</a>
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin One</th>
                    <th>Coin Two</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @php 
                    $i =1;
                    $limit=100;
                    if(isset($_GET['page'])){
                      $page = $_GET['page'];
                      $i = (($limit * $page) - $limit)+1;
                    }else{
                       $i =1;
                    }        
                @endphp 
                @forelse($tradepair as $key => $value)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $value->coinone }}</td>
                    <td>{{ $value->cointwo }}</td>
                    <td>{{ $value->active == 1 ? 'Active' : 'Deactive' }}</td>
                    <td><a href="{{ url('/admin/pairedit', Crypt::encrypt($value->id)) }}" class="btn btn-info">View / Edit</a></td>                    
                  </tr>
                  @php $i++; @endphp
                  @empty
                   <tr><td colspan="7"> {{ 'No List Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $tradepair->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection