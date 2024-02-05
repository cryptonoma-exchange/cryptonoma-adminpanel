<?php $__env->startSection('title', 'Add Coin Settings'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>Add Token settings</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="<?php echo e(url('admin/coinlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back</a>
						<br /><br />
						<?php if(session('status')): ?>
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

							</div>
						<?php endif; ?>

						<?php if(session('error')): ?>
							<div class="alert alert-warning" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button><strong>Failed!</strong> <?php echo e(session('error')); ?>

							</div>
						<?php endif; ?>
						<form method="post" action="<?php echo e(url('admin/addcoininsert')); ?>" autocomplete="off" enctype="multipart/form-data">
							<?php echo e(csrf_field()); ?>

							
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Type <span class="t-red">*</span></label>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label class="custom-control custom-radio">
											<input name="token_type" <?php if(!old('token_type') || old('token_type') == 'ERC20'): ?> checked <?php endif; ?> id="erc20token" type="radio"
												class="" value="ERC20">
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Erc20 Token</span>
										</label>

										<label class="custom-control custom-radio">
											<input type="radio" name="token_type" <?php if(old('token_type') == 'BEP20'): ?> checked <?php endif; ?> id="bep20token"
												class="" value="BEP20">
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Bep20 Token</span>
										</label>
										<br>
										<?php if($errors->has('btn_action')): ?>
											<span class="help-block">
												<strong><?php echo e($errors->first('btn_action')); ?></strong>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<div class='erc20token'>

								<div class="row" id="erc_contract">
									<div class="col-md-3">
										<div class="form-group">
											<label>Contract Address <span class="t-red">*</span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<textarea name="contractaddress" class="form-control" value="" /><?php echo e(old('contractaddress')); ?></textarea><i class="form-group__bar"></i>
											<?php if($errors->has('contractaddress')): ?>
												<span class="help-block">
													<strong><?php echo e($errors->first('contractaddress')); ?></strong>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</div>

								

								
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Token Name <span class="t-red">*</span></label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="coinname" class="form-control" value="<?php echo e(old('coinname')); ?>" /><i
											class="form-group__bar"></i>
										<?php if($errors->has('coinname')): ?>
											<span class="help-block">
												<strong><?php echo e($errors->first('coinname')); ?></strong>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<input type="hidden" name="netfee" class="form-control" value="0" />

							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-8">
									<!-- <div class="loding">Loading...</div> -->
									<div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?>">
										<div class="form-group  has-feedback">
											<div class="col-xs-12 inputGroupContainer"> <img id="doc1" width="128px" height="128px"
													class="img-responsive kyc_img_cls" />
												<label for="file-upload1" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload Image
												</label>
												<input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)" name="image" type="file"
													style="display:none;">
												<label id="file-name1"></label>
												<br />
												<br />
												<?php if($errors->has('image')): ?>
													<span class="help-block"> <strong><?php echo e($errors->first('image')); ?></strong> </span><br />
												<?php endif; ?>
												<p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only svg image format. Recommended image dimension 65 X 65.</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>

	<?php $__env->startPush('child-scripts'); ?>
		<script type="text/javascript">
			$(document).ready(function() {
				//called when key is pressed in textbox
				$("#price_decimal,#amount_decimal ").keypress(function(e) {
					//if the letter is not digit then display error and don't type anything
					if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						//display error message
						$("#errmsg").html("Digits Only").show().fadeOut("slow");
						return false;
					}
				});
			});
		</script>
	<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/tradepair/add.blade.php ENDPATH**/ ?>