<?php
$atitle = 'support';
?>

<?php $__env->startSection('title', 'Tickets - Reply'); ?>
<?php $__env->startSection('content'); ?>
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
				<div class="top-btn"><a href="<?php echo e(url()->previous()); ?>"><i class="zmdi zmdi-arrow-left zmdi-hc-fw"
							aria-hidden="true"></i> Back</a></div>
			</header>
			<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?php echo e($message); ?></strong>
				</div>
			<?php endif; ?>

			<?php if($tickets->status == 1): ?>
				<div class="alert alert-info" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>Chat was closed. You can't send any messages to user. otherwise you can see your chat messages!
				</div>
			<?php endif; ?>

			<?php if($message = Session::get('failed')): ?>
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?php echo e($message); ?></strong>
				</div>
			<?php endif; ?>

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
						<div class="toolbar__label">Send by : <?php echo e($username); ?></div>
					</div>
				</div>
				<div class="messages__content" id="adminchat_div">
					<?php if($chatlist): ?>
						<?php $__currentLoopData = $chatlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($row->message != ''): ?>
								<div class="messages__item">
									<div class="messages__details">
										<?php if($userlist->profileimg): ?>
											<img src="<?php echo e($userlist->profileimg); ?>" />
										<?php else: ?>
											<img src="<?php echo e(url('images/client-2.png')); ?>" />
										<?php endif; ?>
										<p><?php echo e($row->message); ?></p>
                                        <?php if($row->proof): ?>
                                            <a target="_blank" href="<?php echo e($row->proof); ?>"><img class="attachedImage mt-2" width="200px" src="<?php echo e($row->proof); ?>"></a>
                                        <?php endif; ?>
										<small><i class="zmdi zmdi-time"></i><?php echo e($row->created_at); ?></small>
									</div>
								</div>
							<?php endif; ?>
							<?php if($row->reply != ''): ?>
								<div class="messages__item messages__item--right">
									<div class="messages__details">
										<img src="<?php echo e(url('images/adminchat.jpg')); ?>" />
										<p><?php echo e($row->reply); ?></p>
										<small><i class="zmdi zmdi-time"></i> <?php echo e($row->created_at); ?></small>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
				<?php if($tickets->status == 0): ?>
					<?php if(in_array('write', explode(',', $AdminProfiledetails->support))): ?>
						<div class="messages__reply">
							<form method="post" action="<?php echo e(url('admin/tickets/adminsavechat')); ?>" id="chatform"
								enctype="multipart/form-data">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="chat_id" id="chat_id" value="<?php echo e($chatlist[0]->ticketid); ?>">
								<input type="hidden" name="userid" id="userid" value="<?php echo e($chatlist[0]->uid); ?>">
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
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<script type="text/javascript">
	

	function refresh_chat(){
		var chat_id = $('#chat_id').val();
		$.ajax({
			url: "<?php echo e(url('admin/tickets/adminajaxchat')); ?>",
			data: {
				"_token": "<?php echo e(csrf_token()); ?>",
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
				url: '<?php echo e(url('admin/tickets/adminsavechat')); ?>',
				type: 'POST',
				dataType: "json",
				data: {
					"_token": "<?php echo e(csrf_token()); ?>",
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

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/support/reply.blade.php ENDPATH**/ ?>