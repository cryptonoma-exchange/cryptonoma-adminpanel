<?php $__env->startSection('title', 'Add Coin pair Settings'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Add Trade pair</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="<?php echo e(url('admin/tradepairlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Trade pairs</a>
						<br /><br />
						<?php if(session('status')): ?>
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

							</div>
						<?php endif; ?>

						<?php if(session('error')): ?>
							<div class="alert alert-danger" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Error!</strong> <?php echo e(session('error')); ?>

							</div>
						<?php endif; ?>

						<form method="post" action="<?php echo e(url('admin/addpairinsert')); ?>" autocomplete="off">
							<?php echo e(csrf_field()); ?>


							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Coin One</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select name="coinone" class="form-control">
											<option value="">Select Coin/Currency</option>
											<?php $__currentLoopData = $pairres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($value->source); ?>"><?php echo e($value->source); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('coinone')): ?>
											<span class="help-block">
												<strong><?php echo e($errors->first('coinone')); ?></strong>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Coin Two</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<select name="cointwo" class="form-control">
											<option value="">Select Coin/Currency</option>
											<?php $__currentLoopData = $pairres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($value->source); ?>"><?php echo e($value->source); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('cointwo')): ?>
											<span class="help-block">
												<strong><?php echo e($errors->first('cointwo')); ?></strong>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i>Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/tradepair/addpair.blade.php ENDPATH**/ ?>