<?php
$atitle = 'pendingorder';
?>

<?php $__env->startSection('title', ' Trade History'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Pending Trade History</h1>
		</header>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2 tg-select">
						<select onchange="location = this.value;" class="form-control custom-s">
							<?php if(isset($pairs)): ?>
								<option value="<?php echo e(url('admin/pending_tradehistory/all/' . $ordertype)); ?>"
									<?php if($type == 'all'): ?> selected="" <?php endif; ?>>ALL</option>
								<?php $__currentLoopData = $pairs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coinones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e(url('admin/pending_tradehistory/' . $coinones->coinone . '_' . $coinones->cointwo . '/' . $ordertype)); ?>"
										<?php if($coinones->coinone . '_' . $coinones->cointwo == $type): ?> Selected <?php endif; ?>> <?php echo e($coinones->coinone); ?>/<?php echo e($coinones->cointwo); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</select>
					</div>
					<div class="col-md-2 tg-select">

						<select onchange="location = this.value;" class="form-control custom-s">
							<option value="<?php echo e(url('admin/pending_tradehistory/' . $type . '/Buy')); ?>"
								<?php if($ordertype == 'Buy'): ?> selected="" <?php endif; ?>>Buy</option>
							<option value="<?php echo e(url('admin/pending_tradehistory/' . $type . '/Sell')); ?>"
								<?php if($ordertype == 'Sell'): ?> selected="" <?php endif; ?>>Sell</option>
						</select>
					</div>
				</div>
				<div class="tab-content">
					<div id="buyo" class="tab-pane fade in active show">
						<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
							<?php if(session('cancelsuccess')): ?>
								<div class="alert alert-success alert-block">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong><?php echo e(session('cancelsuccess')); ?></strong>
								</div>
							<?php endif; ?>
							<?php if(session('cancelerror')): ?>
								<div class="alert alert-warning alert-block">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong><?php echo e(session('cancelerror')); ?></strong>
								</div>
							<?php endif; ?>
							<table class="table">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Email</th>
										<th>Date & Time</th>
										<th>Trade Pair</th>
										<th>Trade Type</th>
										<th>Amount</th>
										<th>Price</th>
										<th>Remaining</th>
										<th>Fees</th>
										<th>Total Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__empty_1 = true; $__currentLoopData = $trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
										<tr>
											<td><?php echo e($loop->index + $trades->firstItem()); ?></td>
											<td><?php echo e($order->user->email); ?></td>
											<td><?php echo e($order->created_at); ?></td>
											<td><?php echo e($order->pair_string); ?></td>
											<td><?php echo e($order->type); ?></td>
											<td><?php echo e($order->volume); ?></td>
											<td><?php echo e($order->original_price); ?></td>
											<td><?php echo e($order->remaining); ?></td>
											<td><?php echo e($order->fees); ?></td>
											<td><?php echo e($order->value); ?></td>
											<td><a href="<?php echo e(url('admin/cancelOrder/' .$order->type."/". $order->id)); ?>" class="btn btn-warning">Cancel</a></td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
										<tr>
											<td colspan="12">
												<div class="alert alert-info">Yet no trades available</div>
											</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="pagination-tt clearfix">
									<?php echo e($trades->links()); ?>

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

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/tradehistory/pendingtradehistory.blade.php ENDPATH**/ ?>