<?php
$atitle = 'settings';
?>

<?php $__env->startSection('title', 'Support Ticket'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<div class="content__inner">
			<header class="content__title">
				<h1>Email Notifications</h1>
			</header>
			<?php if(session('status')): ?>
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?php echo e(session('status')); ?>

				</div>
			<?php endif; ?>
			<?php if(session('disabledsuccess')): ?>
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?php echo e(session('disabledsuccess')); ?>

				</div>
			<?php endif; ?>
			<div class="card">
				<div class="card-body">
					<form method="post" action="<?php echo e(url('admin/changeusername')); ?>" autocomplete="off">
						<?php echo e(csrf_field()); ?>

						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Notify Email</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group m-0">
									<input type="text" name="notify_mail1" required="required" id="notify_mail1" class="form-control"
										value="<?php echo e($notify_email_ids[0]); ?>">
									<i class="form-group__bar"></i>
								</div>

								<?php if($errors->has('notify_mail1')): ?>
									<span class="help-block">
										<strong class="text text-danger"><?php echo e($errors->first('notify_mail1')); ?></strong>
									</span>
								<?php endif; ?>

							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Notify Email</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group m-0">
									<input type="text" name="notify_mail2" required="required" id="notify_mail2" class="form-control"
										value="<?php echo e($notify_email_ids[1]); ?>">
									<i class="form-group__bar"></i>
								</div>

								<?php if($errors->has('notify_mail2')): ?>
									<span class="help-block">
										<strong class="text text-danger"><?php echo e($errors->first('notify_mail2')); ?></strong>
									</span>
								<?php endif; ?>

							</div>
						</div>

						<div class="form-group">
							<button type="submit" name="save" class="btn btn-light"><i class=""></i> Save</button>
						</div>
					</form>
					<?php if(session('success')): ?>
						<div class="alert alert-success" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?php echo e(session('success')); ?>

						</div>
					<?php endif; ?>
					<?php if(session('error')): ?>
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?php echo e(session('error')); ?>

						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/settings/menu.blade.php ENDPATH**/ ?>