@php
$atitle ="listing";
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
<section class="content">
<header class="content__title">
  <h1>Listing Application</h1>
</header>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>S.No</th>
  
            <th>Name of the issuer</th>
            <th>Email</th>
             <th>Coin name</th>

              <th>Coin short name</th>
         
       <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php 
            $i =1;
            $limit=15;
            if(isset($_GET['page'])){
              $page = $_GET['page'];
              $i = (($limit * $page) - $limit)+1;
            }else{
              $i =1;
            }        
          @endphp 
          @forelse($tickets as $ticket)
          <tr>
            <td>{{ $i }}</td>
         
       
            <td>{{ $ticket->name }}</td>

            <td>{{ $ticket->email }}</td>

             <td>{{ $ticket->coinname }}</td>

              <td>{{ $ticket->coinshortname }}</td>
 <td><a href="{{ url('/admin/listingsettings', Crypt::encrypt($ticket->id)) }}" class="btn btn-info">View</a></td>
          </tr>
          @php
           $i++;
           @endphp
          @empty
             <tr><td colspan="7"> No record found!</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
      <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
      <div class="pagination-tt clearfix">
      @if($tickets->count())
      {{ $tickets->links() }}
      @endif
      </div>
      </div>
  </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> Delete </div>
      <div class="modal-body"> Are you sure you want to delete this user? </div>
      <div class="modal-footer"> <a class="btn btn-danger btn-ok">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
</div>
</section>
@endsection