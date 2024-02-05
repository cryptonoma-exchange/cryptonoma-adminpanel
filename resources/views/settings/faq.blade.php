@php
$atitle ="faq";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
  <header class="content__title">
    <h1 class="pull-left">FAQ</h1>
    <div class="pull-right"><a href="{{ url('admin/faq_add') }}" class="addbtns btn btn-success">Add</a></div>
  </header>
  @if ($message = Session::get('success'))
    <div class="alert alert-info">{{ $message }} </div><br />
  @endif
  <div class="card">
    <div class="card-body">
      <div class="table-responsive search_result">
        @if($faq->count())
        <table class="table" id="dows">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Header</th>
              <th>Action</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            @foreach($faq as $key => $user)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $user->heading }}</td>
              <td><a class="btn btn-success btn-xs" href="{{ url('admin/faq_edit/'.$user->id) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
              <td><a class="btn btn-success btn-xs" href="{{ url('admin/faq_remove/'.$user->id) }}"><i class="zmdi zmdi-delete"></i> Delete </a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else 
        {{ 'No record found! ' }}
        @endif
      </div>
    </div>
  </div>
</div>
</div>
</section>
@endsection


