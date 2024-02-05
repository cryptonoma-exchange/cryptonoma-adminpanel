@php $atitle ="subcategory"; @endphp
@extends('layouts.header')
@section('title', 'Edit Merchant sub category')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Edit Merchant sub category</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/subcategory') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Merchant sub category</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                     @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failed!</strong> {{ session('error') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/subupdatecategory') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $forum->id }}" name="id">
				

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Category</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
				
									<select name="category" class="form-control">
									@foreach($category as $value)
									<option value="{{ $value->id }}" <?php if($forum->cat_id == $value->id) echo "selected"; ?>>{{ $value->category }}</option>
									@endforeach
									</select>

									@if ($errors->has('category'))
									<span class="help-block">
									<strong>{{ $errors->first('category') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>

			
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Method</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="method" class="form-control" required="required">
										<option value="">Select Method</option>
										<option <?php if($forum->method == 'POST') echo "selected"; ?> value="POST">POST</option>
										<option <?php if($forum->method == 'GET') echo "selected"; ?> value="GET">GET</option>
										
									</select>
									<i class="form-group__bar"></i>
									@if ($errors->has('method'))
									<span class="help-block">
									<strong>{{ $errors->first('method') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Sub Category</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="subcategory" class="form-control" value="{{ $forum->sub_title != NULL ? $forum->sub_title : ' ' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('subcategory'))
									<span class="help-block">
									<strong>{{ $errors->first('subcategory') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Description</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="ckeditor" name="description">
									@if(is_object($forum) > 0)
									@php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $forum->desc) @endphp
									{{ $data }}
									@endif
									</textarea>
									@if ($errors->has('description'))
									<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>


			
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection