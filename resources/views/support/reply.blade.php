@php
$atitle = 'support';
@endphp
@extends('layouts.header')
@section('title', 'Tickets - Reply')
@section('content')
<style>
    .attachedImage{
        border-radius: unset !important;
        width: 200px !important;
        height: auto !important;
    }
</style>
	<section class="content">
		<div class="content__inner">
			<header class="content__title">
				<h1>Message</h1>
				<div class="top-btn"><a href="{{ url()->previous() }}"><i class="zmdi zmdi-arrow-left zmdi-hc-fw"
							aria-hidden="true"></i> Back</a></div>
			</header>
			@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
			@endif

			@if ($tickets->status == 1)
				<div class="alert alert-info" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>Chat was closed. You can't send any messages to user. otherwise you can see your chat messages!
				</div>
			@endif

			@if ($message = Session::get('failed'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
			@endif

			<div class="alert alert-danger" style="display:none;" id="require_msg" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<strong>Failed! </strong>Must fill all the fields!
			</div>
			<div class="alert alert-danger" style="display:none;" id="fail_msg" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<strong>Failed! </strong>Try again!
			</div>
		</div>
		<div id="fail_msg">
		</div>
		<div class="messages">
			<div class="messages__body">
				<div class="messages__header">
					<div class="toolbar toolbar--inner mb-0">
						<div class="toolbar__label">Send by : {{ $username }}</div>
					</div>
				</div>
				<div class="messages__content" id="adminchat_div">
					@if ($chatlist)
						@foreach ($chatlist as $row)
							@if ($row->message != '')
								<div class="messages__item">
									<div class="messages__details">
										@if ($userlist->profileimg)
											<img src="{{ $userlist->profileimg }}" />
										@else
											<img src="{{ url('images/client-2.png') }}" />
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
										<img src="{{ url('images/adminchat.jpg') }}" />
										<p>{{ $row->reply }}</p>
										<small><i class="zmdi zmdi-time"></i> {{ $row->created_at }}</small>
									</div>
								</div>
							@endif
						@endforeach
					@endif
				</div>
				@if ($tickets->status == 0)
					@if (in_array('write', explode(',', $AdminProfiledetails->support)))
						<div class="messages__reply">
							<form method="post" action="{{ url('admin/tickets/adminsavechat') }}" id="chatform"
								enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="chat_id" id="chat_id" value="{{ $chatlist[0]->ticketid }}">
								<input type="hidden" name="userid" id="userid" value="{{ $chatlist[0]->uid }}">
								<div class="row">
									<div class="col-lg-10 col-md-10 col-xs-12">
										<textarea class="messages__reply__text message1" name="message" id="admin_support_textbox"
										 placeholder="Type a message..." required></textarea>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-12">
										<div class="adminchat-boxt">
											<input type="hidden" name="csrf" value="sfa">
											<center>
												<input type="button" name="add" class="btn btn-success adminchat" id='btn' onclick="disableBtn()"
													value="Send" />
											</center>
										</div>
									</div>
								</div>
							</form>
						</div>
					@endif
				@endif
			</div>
		</div>
		</div>
	</section>
@endsection
<script type="text/javascript">
	{{-- setInterval(function() {
		var chat_id = $('#chat_id').val();
		$.ajax({
			url: "{{ url('admin/tickets/adminajaxchat') }}",
			data: {
				"_token": "{{ csrf_token() }}",
				"chat_id": $('#chat_id').val(),
			},
			type: "post",
			async: true,
			cache: false,
			success: function(result) {
				$("#adminchat_div").html(result);
			}
		});
	}, 3000); --}}

	function refresh_chat(){
		var chat_id = $('#chat_id').val();
		$.ajax({
			url: "{{ url('admin/tickets/adminajaxchat') }}",
			data: {
				"_token": "{{ csrf_token() }}",
				"chat_id": $('#chat_id').val(),
			},
			type: "post",
			async: true,
			cache: false,
			success: function(result) {
				$("#adminchat_div").html(result);
			}
		});
	}


	function disableBtn() {
		/*document.getElementById("btn").disabled = true;
		$('#btn').val('Please Wait..');
		}



		$(".adminchat").click(function() {
		*/
		var message = $('.message1').val();
		var chat_id = $('#chat_id').val();
		var userid = $('#userid').val();
		document.getElementById("btn").disabled = true;
		$('#btn').val('Please Wait..');
		if (message == '') {
			$("#require_msg").show();
			document.getElementById("btn").disabled = false;
			$('#btn').val('Send');
		}
		if (message != '') {
			$.ajax({
				url: '{{ url('admin/tickets/adminsavechat') }}',
				type: 'POST',
				dataType: "json",
				data: {
					"_token": "{{ csrf_token() }}",
					"message": $('.message1').val(),
					"chat_id": $('#chat_id').val(),
					"userid": $('#userid').val()
				},
				success: function(request) {
					$('.message1').val('');
					document.getElementById("btn").disabled = false;
					$('#btn').val('Send');
					refresh_chat();
					if (request.msg == 'success') {
						$('#chatform')[0].reset();
						$('.message1').val('');
						$('#sug_msg').show();
					} else if (request.msg == 'required') {
						$('#require_msg').show();
					} else {
						$('#sug_msg').hide();
						$('#fail_msg').show();
						$('#sug_msg').hide();
					}
				}
			});
		}
	}
</script>
