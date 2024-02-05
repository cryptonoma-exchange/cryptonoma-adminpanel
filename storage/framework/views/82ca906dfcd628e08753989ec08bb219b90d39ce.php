<?php
$atitle = 'feewalletaddress';
?>

<?php $__env->startSection('title', 'edit Cold wallet address'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Fee wallet address</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 tg-select">
								<?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label><?php echo e($wallet->coinname); ?> address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" value="<?php echo e($wallet->address); ?>" class="form-control">
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/bank/feewalletaddressedit.blade.php ENDPATH**/ ?>