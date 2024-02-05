@php
$atitle ="subscriber";
@endphp
@extends('layouts.header')
@section('title', 'Subscriber - Admin')
@section('content')

<section class="content">
  <header class="content__title">
    <h1>Subscriber List</h1>
  </header>
  

  @if ($message = Session::get('status'))
  <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong> </div>
  @endif
    
    <div class="card">
      <div class="card-body">


        <div class="table-responsive search_result">
          <table class="table downloaddatas" id="subscriber">
              <thead>
              <tr>
              <tr>
              <th>S.No</th>
              <th>Email</th>                 
              <th>Date/Time</th> 
                 @if(in_array("delete", explode(',',$AdminProfiledetails->subscribe))) 
              <th>Delete</th>  
              @endif
              </tr>
              </tr>
              </thead>

                <tbody>
                @if (count($listall) > 0)

                @php
                $limit = 15; 
                if(isset($_GET['page'])){
                $page = $_GET['page'];
                $i = (($limit * $page) - $limit)+1;
                }else{
                $i =1;
                }
                @endphp

                @foreach ($listall as $results)
                <tr>
                <td>{{ $i }}</td>
                <td>{{ $results->email }}</td>
                <td>{{ $results->created_at }}</td>
                 @if(in_array("delete", explode(',',$AdminProfiledetails->subscribe)))
                <td>
                  <a class="btn btn-success btn-xs" href="{{ url('/admin/subscriberdelete/'.Crypt::encrypt($results->id)) }}">Remove </a>
                </td>
                @endif

                </tr>
                @php $i++ @endphp
                @endforeach 
                @else
                <tr><td colspan="4">No records found</td></tr>
                @endif    
                </tbody>
          </table>
          <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
          <div class="pagination-tt clearfix">
          @if($listall->count())
          {{ $listall->links() }}
          @endif
          </div>
          </div>
     </div>
   </div>
 </div>


 @endsection



 