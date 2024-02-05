@php
$atitle = 'feewalletaddress';
@endphp
@extends('layouts.header')
@section('title', 'edit Cold wallet address')
@section('content')
	<section class="content">
		<header class="content__title">
			<h1>Fee wallet address</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 tg-select">
								@foreach ($wallets as $wallet)
										<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>{{$wallet->coinname}} address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" value="{{ $wallet->address }}" class="form-control">
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
@endsection
