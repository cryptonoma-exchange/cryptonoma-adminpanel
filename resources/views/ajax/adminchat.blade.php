@if ($chatlist)
	@foreach ($chatlist as $row)
		@if ($row->message != '')
			<div class="messages__item">
				<div class="messages__details">
					@if ($userlist->profileimg)
						<img src="{{ $userlist->profileimg }}"></img>
					@else
						<img src="{{ url('images/client-2.png') }}"></img>
					@endif
					<p>{{ $row->message }}</p>
					@if ($row->proof)
						<a target="_blank" href="{{ $row->proof }}"><img class="attachedImage mt-2" width="200px" src="{{ $row->proof }}"></a>
					@endif
					<small><i class="zmdi zmdi-time"></i>{{ $row->created_at }}</small>
				</div>
			</div>
		@endif

		@if ($row->reply != '')
			<div class="messages__item messages__item--right">
				<div class="messages__details">
					<img src="{{ url('images/adminchat.jpg') }}"></img>
					<p>{{ $row->reply }}</p>
					<small><i class="zmdi zmdi-time"></i> {{ $row->created_at }}</small>
				</div>
			</div>
		@endif
	@endforeach
@endif
