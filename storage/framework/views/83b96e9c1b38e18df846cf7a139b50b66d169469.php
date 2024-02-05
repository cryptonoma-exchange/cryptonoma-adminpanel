<?php
$atitle = 'deposit';
?>

<?php $__env->startSection('title', 'Deposit History'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>View Deposit</h1>
		</header>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<?php if(session()->has('success')): ?>
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<?php echo e(session()->get('success')); ?>

							</div>
						<?php endif; ?>
						<?php if(session()->has('error')): ?>
							<div class="alert alert-danger" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<?php echo e(session()->get('error')); ?>

							</div>
						<?php endif; ?>

						<a href="<?php echo e(url('admin/deposits/' . $deposit->currency)); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to deposit
							history</a>
						<br /><br />
						<form method="post" id="currency_form" action="<?php echo e(url('admin/fiatdeposit_update')); ?>" autocomplete="off">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" value="<?php echo e($deposit->id); ?>" name="id">

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Currency</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo e($deposit->currency); ?>"
											readonly disabled/><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Transaction Id</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="txid" class="form-control" value="<?php echo e($deposit->txid ? $deposit->txid : '-'); ?>"
											readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Payment Type</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control"
											value="<?php echo e($deposit->paymenttype ? $deposit->paymenttype : '-'); ?>" readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Request Amount</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="amount" class="form-control"
											value="<?php echo e(number_format($deposit->amount, 2, '.', '')); ?>" readonly /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Credit Amount</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="credit_amount" class="form-control"
											value="<?php echo e(number_format($deposit->credit_amount, 2, '.', '')); ?>" /><i class="form-group__bar"></i>
									</div>
								</div>
							</div>

							<?php if($deposit->paymenttype == "wirepayment"): ?>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Uploaded Proof</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<img src="<?php echo e($deposit->proof); ?>" width="50%" /><i class="form-group__bar"></i><br /><br />
										<a href="<?php echo e($deposit->proof); ?>" target="_blank">Click to view large</a>
									</div>
								</div>
							</div>
							<?php elseif($deposit->paymenttype == "tinypesa"): ?>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone Number</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo e($deposit->account_no); ?>"
											readonly disabled/><i class="form-group__bar"></i>
									</div>
								</div>
							</div>
							<?php endif; ?>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Status</label>
									</div>
								</div>
								<?php if($deposit->status == 0): ?>
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
									<?php if($deposit->status == 1): ?>
										Approved
									<?php endif; ?>
									<?php if($deposit->status == 2): ?>
										Rejected
									<?php endif; ?>
									<?php if($deposit->status == 3): ?>
										Cancelled by user
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<?php if(in_array('write', explode(',', $AdminProfiledetails->depositlist))): ?>
								<?php if($deposit->status == 0 && $deposit->paymenttype != "tinypesa"): ?>
									<div class="form-group">
										<button type="submit" name="edit" class="btn btn-light" id="btn_update"><i class=""></i>
											Update</button>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/userdeposit/deposit_edit.blade.php ENDPATH**/ ?>