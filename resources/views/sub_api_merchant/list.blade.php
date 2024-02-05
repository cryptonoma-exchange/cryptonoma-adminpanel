@php $atitle ="subcategory"; @endphp
@extends('layouts.header')
@section('title', 'Merchant Api SubCategory List')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1 class="card-title">Merchant Api SubCategory List</h1>
    </header>
    <div class="row">

      <div class="col-md-12">
        <a href="{{ url('/admin/subaddcat') }}" class="btn btn-info">Add SubCategory</a>
        </br><br>

          @if(session('status'))
          <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
          </div>
          @endif
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
           
              @if(count($forum) > 0)
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Method</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Date/time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                  @php
                $limit=10;
                $i=1;
                if(isset($_GET['page'])){
                $page = $_GET['page'];
                $i = (($limit * $page) - $limit)+1;
                }else{
                $i =1;
                }
                @endphp
                @foreach($forum as $key => $value)
                  <tr>
                    <td>{{ $i }}</td>
                    @php

                    $apicat = \App\Models\Apicategory::where('id',$value->cat_id)->first();
                    @endphp
                    <td>{{ $value->method }}</td>
                    <td>{{ $apicat->category }}</td>
                    <td><?php echo mb_strimwidth($value->sub_title, 0, 30, '...');?></td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ url('/admin/subviewcategory', Crypt::encrypt($value->id)) }}" class="btn btn-info">View / Edit </a>
                    <a href="{{ url('/admin/subcat_delete/'.Crypt::encrypt($value->id)) }}" class="btn btn-info">Remove </a>
                    </td>

               
                    
                  </tr>
                  @php $i++; @endphp  
                @endforeach
                </tbody>
              </table>
              {{ $forum->links() }}
              @else
                {{ 'No Records Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection