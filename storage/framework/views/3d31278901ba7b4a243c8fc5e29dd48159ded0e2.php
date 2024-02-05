<?php
	$atitle = 'kycview';
?>

<?php $__env->startSection('title', 'Kyc List - Admin'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Kyc Submit</h1>
		</header>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive search_result">
					<table class="table" id="dows">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date & Time</th>
								<th>Username</th>
								<th>Email Id</th>
								<th>Status</th>
								<th>Remarks</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $__empty_1 = true; $__currentLoopData = $kycs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<tr>
									<td><?php echo e($loop->index + $kycs->firstItem()); ?></td>
									<td><?php echo e(date('m-d-Y H:i:s', strtotime($kyc->created_at))); ?></td>
									<td><?php echo e($kyc->user['name']); ?></td>
									<td><?php echo e($kyc->user['email']); ?></td>
									<td>
										<?php if($kyc->status == 0): ?>
											Initialized
										<?php elseif($kyc->status == 1): ?>
											Accepted
										<?php elseif($kyc->status == 2): ?>
											Rejected
										<?php elseif($kyc->status == 3): ?>
											Waiting
										<?php else: ?>
											No
										<?php endif; ?>
									</td>
									<td><?php echo e($kyc->remark); ?></td>
									<td><a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/kycview/' . Crypt::encrypt($kyc->kyc_id))); ?>"><i
												class="zmdi zmdi-edit"></i> View </a></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<tr>
									<td colspan="7"> No record found!</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
					<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
						<div class="pagination-tt clearfix">
							<?php if($kycs->count()): ?>
								<?php echo e($kycs->links()); ?>

							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/kyc.blade.php ENDPATH**/ ?>