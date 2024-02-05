<?php
$atitle = 'withdraw';
?>

<?php $__env->startSection('title', 'Withdraw History'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1><?php echo e($currency); ?> Withdraw History</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive search_result">
							<table class="table" id="dows">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Date & Time</th>
										<th>paymenttype </th>
										<th>Username</th>
										<th>Requested Withdraw Amount (<?php echo e($currency); ?>)</th>
										<th>Withdraw Fee (<?php echo e($currency); ?>)</th>
										<th>Total receiving amount (<?php echo e($currency); ?>)</th>
										<th style="min-width: 250px">Reason</th>
										<th>Status</th>
										<?php if(in_array('read', explode(',', $AdminProfiledetails->withdrawlist))): ?>
											<th>Action</th>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php if(count($transaction) > 0): ?>
										<?php
											$i = 1;
											
											$limit = 15;
											
											if (isset($_GET['page'])) {
											    $page = $_GET['page'];
											    $i = $limit * $page - $limit + 1;
											} else {
											    $i = 1;
											}
										?>
										<?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($i); ?></td>
												<td><?php echo e(date('Y/m/d h:i:s', strtotime($transactions->created_at))); ?></td>
												<td><?php echo e($transactions->paymenttype); ?></td>
												<td><?php echo e(username($transactions->uid)); ?></td>
												<td><?php echo e(number_format($transactions->totalamount, 2, '.', '')); ?></td>
												<td><?php echo e(number_format($transactions->fee, 2, '.', '')); ?></td>
												<td><?php echo e(number_format($transactions->amount, 2, '.', '')); ?></td>
												<td style="white-space: normal;"><?php echo e($transactions->remark); ?></td>
												<td>
													<?php if($transactions->status == 0): ?>
														Waiting for admin confirmation
													<?php elseif($transactions->status == 2): ?>
														Rejected by admin
													<?php elseif($transactions->status == 3): ?>
														Cancelled by user
													<?php else: ?>
														Approved by admin
													<?php endif; ?>
												</td>
												<?php if(in_array('read', explode(',', $AdminProfiledetails->withdrawlist))): ?>
													<td><a class="btn btn-success btn-xs"
															href="<?php echo e(url('/admin/withdraw_edit/' . Crypt::encrypt($transactions->id))); ?>"><i
																class="zmdi zmdi-edit"></i> View </a> </td>
												<?php endif; ?>
											</tr>
											<?php
												$i++;
											?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
										<tr>
											<td colspan="9"> No record found!</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
								<div class="pagination-tt clearfix">
									<?php if($transaction->count()): ?>
										<?php echo e($transaction->links()); ?>

									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/userwithdraw/fiat_withdraw.blade.php ENDPATH**/ ?>