@extends('layouts.header')
@section('title', 'Instant Trade History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Instant Sell Trade History</h1>
	</header>
	@if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        {{ session()->get('error') }}
                        </div>
      @endif
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 tg-select-left">
					
				</div>
				<div class="col-md-6 tg-select">
					
					<select onchange="location = this.value;" class="form-control custom-s">
                    @if(isset($pairs))
                        <option value="{{ url('admin/instantselltradehistory/'.$tradepair->coinone.'_'.$tradepair->cointwo) }}">{{ $tradepair->coinone }} / {{ $tradepair->cointwo }}</option>
                        @foreach($pairs as $coinones) 
	                        @if($coinones->coinone.'_'.$coinones->cointwo != $tradepair->coinone.'_'.$tradepair->cointwo)
	                        	<option value="{{ url('admin/instantselltradehistory/'.$coinones->coinone.'_'.$coinones->cointwo) }}">{{ $coinones->coinone }} / {{ $coinones->cointwo }}</option>
	                        @endif
                        @endforeach
                    @endif
                  </select>
				</div>
			</div>
			<div class="tab-content">
				<div id="buyo" class="tab-pane fade in active show">
					<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
						<table class="table" id="dows">
							<thead>
								<tr>
									<th>Date & Time</th>
									<th>User Name</th>
									<th>{{ $tradepair->coinone }} Price in ({{ $tradepair->cointwo }})</th>
									<th>Paid Amount ({{ $tradepair->coinone }})</th>
									<th>Received Amount ({{ $tradepair->cointwo }})</th>
								</tr>
							</thead>
							<tbody>
					@if($selltrade->count())

								@foreach($selltrade as $transactions)
								    @php 
								    $coinone_decimal = 8;
								    $cointwo_decimal = 8;
								    @endphp
                                   
								<tr>
									<td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at)) }}</td>
									<td><a href="{{ url('/admin/users_edit/'.Crypt::encrypt($transactions->uid)) }}">{{ $transactions->userDetails['name'] }}</a></td>
									<td>{{ number_format($transactions->price, $cointwo_decimal, '.', '') }}</td>
									<td>{{ number_format($transactions->paid_amount, $coinone_decimal, '.', '') }}</td>
									<td>{{ number_format($transactions->receive_amount, $cointwo_decimal, '.', '') }}</td>
								</tr>
								@endforeach

						@else 
							<tr><td colspan="5">Yet no trades available</td></tr>
						@endif
							</tbody>
						</table>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($selltrade->count())
				    {{ $selltrade->links() }}
				@endif
                </div>
              </div>
				</div>
			</div>
		</div>
	</div>

@endsection
<script>
    function pageredirect(self){
	window.location.href = self.value;
}
</script>