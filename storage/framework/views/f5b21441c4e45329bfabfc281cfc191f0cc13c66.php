<?php
$atitle = 'users';
?>

<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1>View User Details</h1>
		</header>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<a href="<?php echo e(url('admin/users')); ?>"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
						<br /><br />
						<?php if(session('updated_status')): ?>
							<div class="alert alert-success">
								<?php echo e(session('updated_status')); ?>

							</div>
						<?php endif; ?>

						<?php if(session('updated_error')): ?>
							<div class="alert alert-danger">
								<?php echo e(session('updated_error')); ?>

							</div>
						<?php endif; ?>

						<div class="tab-container">

							<?php echo $__env->make("user.menu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

							</br>
						</div>

						<form method="post" action="<?php echo e(url('admin/update_user/'.$userdetails->id)); ?>" autocomplete="off">
							<?php echo e(csrf_field()); ?>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Full Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" name="fname" class="form-control" readonly disabled
											value="<?php echo e($userdetails->name != null ? $userdetails->name : ''); ?>" /><i class="form-group__bar"></i>
										<?php if($errors->has('fname')): ?>
											<span class="help-block">
												<strong class="text text-danger"><?php echo e($errors->first('fname')); ?></strong>
											</span>
										<?php endif; ?>
									</div>

								</div>

							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Email Id</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="email" name="email" class="form-control" value="<?php echo e($userdetails->email); ?>" readonly/><i
											class="form-group__bar"></i>
									</div>
									<?php if($errors->has('email')): ?>
										<span class="help-block">
											<strong class="text text-danger"><?php echo e($errors->first('email')); ?></strong>
										</span>
									<?php endif; ?>
								</div>

							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Country</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select class="form-control" name="country" readonly disabled>
											<?php if($userdetails->country == ''): ?>
												<option value=""></option>
												<?php $__currentLoopData = country(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $userdetails->country): ?> selected <?php endif; ?>>
														<?php echo e($countrys->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
												<?php $__currentLoopData = country(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $userdetails->country): ?> selected <?php endif; ?>>
														<?php echo e($countrys->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</select>
										<?php if($errors->has('country')): ?>
											<span class="help-block">
												<strong class="text text-danger"><?php echo e($errors->first('country')); ?></strong>
											</span>
										<?php endif; ?>

									</div>

								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone No</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" name="phone" class="form-control" value="<?php echo e($phone); ?>" readonly disabled/><i
											class="form-group__bar"></i>
										<?php if($errors->has('phone')): ?>
											<span class="help-block">
												<strong class="text text-danger"><?php echo e($errors->first('phone')); ?></strong>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Address</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<textarea class="form-control" rows="3" cols="10" name="address" readonly disabled><?php echo e($address); ?></textarea>
										<?php if($errors->has('address')): ?>
											<span class="help-block">
												<strong class="text text-danger"><?php echo e($errors->first('address')); ?></strong>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Email Verify</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-group">
											<?php if($userdetails->email_verify == 1): ?>
												<select name="emailcheck" class="form-control">
													<option value="1">Verified</option>
													<option value="0">Not Verify</option>
												</select>
											<?php else: ?>
												<select name="emailcheck" class="form-control" required>
													<option value="0">Not Verify</option>
													<option value="1">Verified</option>
												</select>
											<?php endif; ?>

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>2FA Access</label>
									</div>
								</div>
								<div class="col-md-4">
								<?php if(!empty($userdetails->twofa)): ?>
								<div class="form-group">
										<div class="form-group">

											<select name="twofactor" class="form-control">
												<?php if(!empty($userdetails->twofa)): ?>
													<option value=""><?php echo e($userdetails->twofa == "email_otp" ? "Email" : "Google Authenticator"); ?> Enabled</option>
													<option value="1">Disable</option>
												<?php endif; ?>
												<?php if($userdetails->twofa == 'google_otp'): ?>
													<option value="2">Change to Email OTP</option>
												<?php endif; ?>
											</select>
										</div>
									</div>
								<?php else: ?>
									<div class="form-group">
										<input type="text" class="form-control" value="Not enabled" readonly disabled/><i
											class="form-group__bar"></i>
									</div>
								<?php endif; ?>
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> User Deleted</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<div class="toggle-switch">

											<input type="checkbox" class="toggle-switch__checkbox" name="deleted"
												<?php if($userdetails->deleted == 1): ?> checked="" <?php endif; ?> value="1">
											<i class="toggle-switch__helper"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> User block</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<div class="toggle-switch">

											<input type="checkbox" class="toggle-switch__checkbox" name="user_status"
												<?php if($userdetails->status == 1): ?> checked="" <?php endif; ?> value="1">
											<i class="toggle-switch__helper"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label> User block reason</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<textarea rows="4" name="reason_block" class="form-control"><?php echo e($userdetails->reason); ?></textarea>
									</div>
								</div>
							</div>
							

							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php if(session('withdraw_status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('withdraw_status')); ?>

			</div>
		<?php endif; ?>

		<?php if(session('withdraw_error')): ?>
			<div class="alert alert-danger">
				<?php echo e(session('withdraw_error')); ?>

			</div>
		<?php endif; ?>

		<?php if(count($Bankuser) > 0): ?>
			<div class="card">
				<div class="card-body">
					<h5 class="">BANK DETAILS</h5></br>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>S.No</th>
								<th>Bank name</th>
								
								<th>Swiftcode</th>
								<th>Account number</th>
								
								<th>Country</th>
								

							</thead>
							<tbody>
								<?php $i =1 ;?>
								<?php $__currentLoopData = $Bankuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($i); ?></td>
										<td><?php echo e($bank->bank_name ? $bank->bank_name : '-'); ?></td>

										
										<td><?php echo e($bank->swift_code ? $bank->swift_code : '-'); ?></td>
										<td><?php echo e($bank->account_no ? $bank->account_no : '-'); ?></td>
										
										<td><?php echo e($bank->countrydata ? $bank->countrydata : '-'); ?></td>
										

									</tr>
									<?php $i++;?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php endif; ?>

	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/user_edit.blade.php ENDPATH**/ ?>