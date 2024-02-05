<?php
$atitle ="users";
?>

<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>Coin deposit history</h1>
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
							<th>Coin Name</th>
							<th>Txn Id</th>
							<th>Sender</th>
							<th>Recipient</th>
							<th>Amount</th>
							<th colspan="2">Action</th>
							</tr>
							</thead>
							<tbody>					
							<?php if($depositList->count()): ?> 
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
							<?php $__currentLoopData = $depositList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $histroy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
							<td><?php echo e($i); ?></td>
							<td><?php echo e(date('Y-m-d h:i:s', strtotime($histroy->created_at))); ?> </td>
							<td><?php echo e($histroy->currency); ?></td>
							<td><?php echo e($histroy->txid); ?></td>
							<td><?php echo e($histroy->from_addr ? $histroy->from_addr : '-'); ?></td>
							<td><?php echo e($histroy->to_addr  ? $histroy->to_addr  : '-'); ?></td>
							<td><?php echo e($histroy->amount); ?></td>
							<td>
							<?php if($histroy->status==0): ?>
							<a class="btn btn-success btn-xs" href="<?php echo e(url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
							<?php elseif($histroy->status==2): ?>
							Approved
							<?php elseif($histroy->status==3): ?>
							Cancelled
							<?php else: ?>
							-
							<?php endif; ?> 
							</td>
							</tr>
							<?php
				         		$i++;
				         	?> 
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?> 
							<td colspan="10">	<?php echo e('No record found! '); ?></td>
							<?php endif; ?>
							</tbody>
							</table>
						</div>


				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/user_deposit.blade.php ENDPATH**/ ?>