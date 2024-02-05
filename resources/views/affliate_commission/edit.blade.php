@extends('layouts.header')
@section('title', 'Affiliate Commission Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Affiliate Commission Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/aff_commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Affiliate Commission</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/aff_commissionupdate') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $AffilateCommission->id }}" name="id">
							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Generation</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="generation" class="form-control" value="{{ $AffilateCommission->generation != NULL ? $AffilateCommission->generation : '0' }}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin / Token</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="coin_name">
									@foreach($commission as $key => $value)
									<option value="{{ $value->source }}"  @if($value->source == $AffilateCommission->coin ) selected @endif >{{ $value->source }}</option>
									@endforeach
									</select>
									@if ($errors->has('coin_name'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('coin_name') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div>


					
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Deposit Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="deposit" class="form-control"  step="0.01" min="0" max="10000000" value="{{ $AffilateCommission->deposit != NULL ? $AffilateCommission->deposit : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('deposit'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('deposit') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div> 
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="trade"  step="0.01" min="0" max="10000000" class="form-control" value="{{ $AffilateCommission->trade != NULL ? $AffilateCommission->trade : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('trade'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('trade') }}</strong>
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