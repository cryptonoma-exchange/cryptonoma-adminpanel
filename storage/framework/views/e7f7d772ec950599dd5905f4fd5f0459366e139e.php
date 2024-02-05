<?php
$atitle ="users";
?>

<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>Currency deposit history</h1>
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
							<th>Currency</th>
							<th>Deposited Amount</th>
							<th>Credited Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    <?php if(count($deposit) > 0): ?>
					    <?php 
						        $i =1;
					            $limit=15;
					            if(isset($_GET['page'])){
									$page = $_GET['page'];
									$i = (($limit * $page) - $limit)+1;
								}else{
								  $i =1;
								}        
							?>
						<?php $__currentLoopData = $deposit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($i); ?></td>
							<td><?php echo e(date('Y-m-d h:i:s', strtotime($transactions->created_at))); ?></td>
							<td><?php echo e($transactions->currency); ?></td>
							<td><?php echo e(number_format($transactions->amount, 2, '.', '')); ?></td>
							<td><?php echo e(number_format($transactions->credit_amount, 2, '.', '')); ?></td>
							<td>
							    <?php if($transactions->status == 0): ?> 
							    	Waiting for admin confirmation
                                <?php elseif($transactions->status == 2): ?> 	
                                	Rejected by admin
                                <?php elseif($transactions->status == 3): ?> 
                                	Cancelled by user
                                <?php else: ?> 
                                	Approved by admin 
                                <?php endif; ?>
							</td>
							<td>
								<?php if($transactions->status == 0): ?> 
									<a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/fiatdeposit_edit/'.Crypt::encrypt($transactions->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
                                <?php else: ?> 
                                	--
                                <?php endif; ?> 

							</td>
						</tr>
						<?php
				         		$i++;
				         	?> 
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					    <tr><td colspan="7"> No record found!</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
				<?php if(count($deposit) > 0): ?>
				    <?php echo e($deposit->links()); ?>

				<?php endif; ?>
			</div>

				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/user_fiat_deposit.blade.php ENDPATH**/ ?>