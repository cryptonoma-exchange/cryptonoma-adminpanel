@php
$atitle ="contact";
@endphp
@extends('layouts.header')

@section('title', 'Contactus - Admin')
@section('content')


<section class="content">
 <header class="content__title">
    <h1>Contact List</h1>
  </header>
  

  
  <div class="card">
    <div class="card-body">



      @if ($message = Session::get('contactuserupdate'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
      </div>
      @endif


        <div class="table-responsive search_result">
          <table class="table downloaddatas" id="contactus">
            <thead>
             <tr>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>                 
                <th>Subject</th>
                <th>Phone no</th> 
                <th>Message</th>  
                <th>Created</th>
                <th>Action</th>  
              </tr>
            </tr>
          </thead> 
          <tbody>
            @if (count($listall) > 0)
            @php
            $limit=25;
            $i=1;
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
         <td>{{ $results->name }}</td>
         <td>{{ $results->email }}</td>
         <td>{{ $results->subject }}</td>
         <td>{{ $results->phone }}</td>
         <td class="msglistcnt">{{ $results->message }}</td>
         <td>{{ date('d-m-Y H:i:s',strtotime($results->created_at)) }}</td>
         <td> 
          
           <a class="btn btn-success btn-xs" href="{{ url('/admin/contactremove/'.Crypt::encrypt($results->id)) }}">Remove </a>

        </td>
        
      </tr>
      @php $i++ @endphp
      @endforeach 
      @else
      <tr><td colspan="8">No records found!</td></tr>
      @endif    
    </tbody>
    
    
  </table>
  {{ $listall->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}    

  
  
</div>
</div>
</div>


@endsection



