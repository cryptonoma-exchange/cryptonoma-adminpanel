<?php
$atitle = 'users';
?>

<?php $__env->startSection('title', ' Trade History'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Buy Trade History</h1>
		</header>

		<div class="card">
			<div class="card-body">
				<a href="<?php echo e(url('admin/users')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
				<br /><br />
				<div class="tab-container">

					<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					</br>
				</div>

				<div class="tab-content">
					<div id="buyo" class="tab-pane fade in active show">
						<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
							<table class="table" id="dows">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>Date & Time</th>
										<th>Order Type</th>
										<th>Price</th>
										<th>Amount</th>
										<th>Remaining</th>
										<th>Total</th>
										<th>Trade Fee</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php $__empty_1 = true; $__currentLoopData = $buytrade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
										<tr>
											<td><?php echo e($loop->index + $buytrade->firstItem()); ?></td>
											<td><?php echo e($trade->created_at); ?></td>
											<td><?php echo e($trade->order_type_string); ?></td>
											<td><?php echo e($trade->original_price); ?></td>
											<td><?php echo e($trade->volume); ?></td>
											<td><?php echo e($trade->remaining); ?></td>
											<td><?php echo e($trade->value); ?></td>
											<td><?php echo e($trade->fees); ?></td>
											<td><?php echo e($trade->status_string); ?></td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
										<tr>
											<td colspan="10">
												<div class="alert alert-info">Yet no trades available</div>
											</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="pagination-tt clearfix">
									<?php echo e($buytrade->links()); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php $__env->stopSection(); ?>
	<script>
		function pageredirect(self) {
			window.location.href = self.value;
		}
	</script>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/buytradehistory.blade.php ENDPATH**/ ?>