@php
$atitle ="adminbank";
@endphp
@extends('layouts.header')
@section('title', 'Admin Bank')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Mpesa Details</h1>
	</header>

	@if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			
			<div class="row">
				<div class="col-md-6 tg-select-left">
				
				</div>
				<div class="col-md-6 tg-select">
					

			@if(count($mpesa)== 0)
			<a href="{{ url('addmpesa') }}" class="btn btn-info pull-right">Add</a>
			@endif

				
				</div>
			</div>
		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.no</th>
							<th>APIkey</th>
							<th>Shortcode</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    @if(count($mpesa) > 0)
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
						  @foreach($mpesa as $mpesas)
							
						<tr>
							<td>{{ $i }}</td>
							{{-- <td>{{ $mpesas->passkey }}</td> --}}
							<td>{!!  substr(strip_tags( $mpesas->passkey), 0, 4)!!}******************************{!!  substr(strip_tags(  $mpesas->passkey), -4, 4)!!}</td>
							<td>{{ $mpesas->shortcode}}</td>		 
							<td><a class="btn btn-success btn-xs" href="{{ url('admin/mpesa/edit') }}"><i class="zmdi zmdi-edit"></i> Update </a> </td>
						</tr>
						@php
			           $i++;
			           @endphp
					@endforeach
					@else
					    <tr><td colspan="7"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection