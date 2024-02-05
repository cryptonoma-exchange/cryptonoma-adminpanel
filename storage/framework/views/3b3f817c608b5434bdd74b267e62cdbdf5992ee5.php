<?php
$atitle = 'users';
?>

<?php $__env->startSection('title', 'Users Kyc - Admin'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>User Kyc</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="<?php echo e(url('admin/users')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
						<br /><br />
						<?php if(session('updated_status')): ?>
							<div class="alert alert-success">
								<?php echo e(session('updated_status')); ?>

							</div>
						<?php endif; ?>

						<div class="tab-container">

							<?php echo $__env->make("user.menu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

							</br>
						</div>
						<div class="table-responsive search_result">

							<table class="table" id="dows">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Date & Time</th>
										<th>Username</th>
										<th>Email ID</th>
										<th>Status</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										$limit = 10;
										if (isset($_GET['page'])) {
										    $page = $_GET['page'];
										    $i = $limit * $page - $limit + 1;
										} else {
										    $i = 1;
										}
									?>
									<?php $__empty_1 = true; $__currentLoopData = $kyc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
										<tr>
											<td><?php echo e($i); ?></td>
											<td><?php echo e(date('m-d-Y H:i:s', strtotime($user->created_at))); ?></td>
											<td><?php echo e($user->user['name']); ?></td>
											<td><?php echo e($user->user['email']); ?></td>
											<td>
												<?php if($user->status == 0): ?>
													Initialized
												<?php elseif($user->status == 1): ?>
													Accepted
												<?php elseif($user->status == 2): ?>
													Rejected
												<?php elseif($user->status == 3): ?>
													Waiting
												<?php else: ?>
													No
												<?php endif; ?>
											</td>
											<td><?php echo e($user->remark); ?></td>
										</tr>
										<?php
											$i++;
										?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
										<tr>
											<td colspan="7"> No record found!</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="pagination-tt clearfix">
								<?php if($kyc->count()): ?>
									<?php echo e($kyc->links()); ?>

								<?php endif; ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/user_kyc.blade.php ENDPATH**/ ?>