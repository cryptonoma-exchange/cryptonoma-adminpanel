<?php
$atitle = 'coldwalletaddress';
?>

<?php $__env->startSection('title', 'edit Cold wallet address'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Cold wallet address</h1>
		</header>

		<?php if(session('status')): ?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

			</div>
		<?php endif; ?>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						

						<div class="row">
							
							<div class="col-12 tg-select">

								<form action="<?php echo e(url('admin/coldwalletaddress/update')); ?>" method="post">
									<?php echo csrf_field(); ?>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>BTC address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group <?php echo e($errors->has('btc_address') ? ' has-error' : ''); ?>">
												<input type="text" name="btc_address" value="<?php echo e($coldwallet->btc_address); ?>" class="form-control"
													required="required">
												<?php if($errors->has('btc_address')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('btc_address')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>BNB address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group <?php echo e($errors->has('bnb_address') ? ' has-error' : ''); ?>">

												<input type="text" name="bnb_address" value="<?php echo e($coldwallet->bnb_address); ?>" class="form-control"
													required="required">
												<?php if($errors->has('bnb_address')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('bnb_address')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>LTC address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group <?php echo e($errors->has('ltc_address') ? ' has-error' : ''); ?>">
												<input type="text" name="ltc_address" value="<?php echo e($coldwallet->ltc_address); ?>" class="form-control"
													required="required">
												<?php if($errors->has('ltc_address')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('ltc_address')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>XRP address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group <?php echo e($errors->has('xrp_address') ? ' has-error' : ''); ?>">
												<input type="text" name="xrp_address" value="<?php echo e($coldwallet->xrp_address); ?>" class="form-control"
													required="required">
												<?php if($errors->has('xrp_address')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('xrp_address')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>

                                    <div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>XRP Tag</label>
											</div>
										</div>
										<div class="col-md-6">
                                            <div class="form-group <?php echo e($errors->has('xrp_tag') ? ' has-error' : ''); ?>">
												<input type="text" name="xrp_tag" value="<?php echo e($coldwallet->xrp_tag); ?>" class="form-control"
													required="required">
												<?php if($errors->has('xrp_tag')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('xrp_tag')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>BCH address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group <?php echo e($errors->has('bch_address') ? ' has-error' : ''); ?>">
												<input type="text" name="bch_address" value="<?php echo e($coldwallet->bch_address); ?>" class="form-control"
													required="required">
												<?php if($errors->has('bch_address')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('bch_address')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>ETH address</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group <?php echo e($errors->has('eth_address') ? ' has-error' : ''); ?>">
												<input type="text" name="eth_address" value="<?php echo e($coldwallet->eth_address); ?>" class="form-control"
													required="required">
												<?php if($errors->has('eth_address')): ?>
													<span class="help-block">
														<strong><?php echo e($errors->first('eth_address')); ?></strong>
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="alert alert-danger" role="alert">
											Warning:
											<ul class="mb-0">
												<li>Please be careful before changing the cold wallet address.</li>
												<li>All user deposits will be moved to this cold wallet address only.</li>
												<li>Double check before updating the cold wallet address.</li>
											</ul>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-light"><i class=""></i> Submit</button>
									</div>

								</form>

							</div>
						</div>
						<div class="table-responsive search_result">

						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/bank/coldwalletaddressedit.blade.php ENDPATH**/ ?>