<?php
$atitle = 'withdraw';
?>

<?php $__env->startSection('title', 'Withdraw History'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1><?php echo e($withdraw->type); ?> History</h1>
		</header>
		<?php if(session('status')): ?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

			</div>
		<?php endif; ?>
		<?php if(session('error')): ?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button><strong>Failed!</strong> <?php echo e(session('error')); ?>

			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="<?php echo e(url('admin/withdraw/' . $withdraw->currency)); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to withdraw
							history</a>
						<br /><br />
						<form method="post" id="currency_form" action="<?php echo e(url('admin/withdraw_update')); ?>" autocomplete="off">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" value="<?php echo e($withdraw->id); ?>" name="id">
							<input type="hidden" value="<?php echo e($withdraw->type); ?>" name="currency">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Currency</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo e($withdraw->currency); ?>" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Payment Type</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo e($withdraw->paymenttype); ?>" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<?php if($withdraw->paymenttype == "wirepayment"): ?>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Bank Name</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="bank" class="form-control" value="<?php echo e($withdraw->bank_name); ?>" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Account Number</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="account_no" class="form-control" value="<?php echo e($withdraw->account_no); ?>" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Swift Code</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="swift_code" class="form-control" value="<?php echo e($withdraw->swift_code); ?>" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Bank Nationality</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="countrydata" class="form-control" value="<?php echo e($withdraw->coutryregion); ?>" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
							<?php elseif($withdraw->paymenttype == "tinypesa"): ?>
							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Name</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="account_name" class="form-control" value="<?php echo e($withdraw->account_name); ?>" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Phone Number</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="account_no" class="form-control" value="<?php echo e($withdraw->account_no); ?>" readonly /><i
												class="form-group__bar"></i>
										</div>
									</div>
								</div>
							<?php endif; ?>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Transaction ID </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="tran_id" class="form-control"
											value="<?php echo e($withdraw->txid != null ? $withdraw->txid : '-'); ?>" readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Requested Withdraw Amount </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="amount" class="form-control"
											value="<?php echo e($withdraw->totalamount != null ? number_format($withdraw->totalamount, 2, '.', '') : 0); ?>"
											readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Withdraw Fee </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="fee" class="form-control"
											value="<?php echo e($withdraw->fee != null ? number_format($withdraw->fee, 2, '.', '') : 0); ?>" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Total Receiving Amount </label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="total_amount" class="form-control"
											value="<?php echo e($withdraw->amount != null ? number_format($withdraw->amount, 2, '.', '') : 0); ?>" readonly /><i
											class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Status</label>
									</div>
								</div>
								<?php if($withdraw->status == 0): ?>
									<div class="col-md-4">
										<div class="form-group">
											<select class="form-control" name="status">
												<option value="0">Waiting for approval</option>
												<option value="1">Approved</option>
												<option value="2">Rejected</option>
											</select>
										</div>
									</div>

									<div class="col-md-12">
										<p class="text text-info">NOTE : Once you update the status as "Approved / Rejected", you can't update status
											again!</p>
									</div>
								<?php else: ?>
									<div class="col-md-4">
										<div class="form-group">
											<select class="form-control" disabled="">
												<option>
													<?php if($withdraw->status == 1): ?>
														Approved
													<?php endif; ?>
													<?php if($withdraw->status == 2): ?>
														Rejected
													<?php endif; ?>
													<?php if($withdraw->status == 3): ?>
														Cancelled by user
													<?php endif; ?>
												</option>
											</select>
										</div>
									</div>
								<?php endif; ?>
							</div>

							<?php if(in_array('write', explode(',', $AdminProfiledetails->withdrawlist))): ?>
								<?php if($withdraw->status == 0): ?>
									<div class="form-group">
										<button type="submit" name="edit" id="btn_update" class="btn btn-light"><i class=""></i>
											Update</button>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</form>
						<hr />

					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/userwithdraw/withdraw_edit.blade.php ENDPATH**/ ?>