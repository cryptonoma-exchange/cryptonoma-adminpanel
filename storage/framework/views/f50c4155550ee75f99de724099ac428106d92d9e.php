<?php
$atitle ="deposit";
?>

<?php $__env->startSection('title', '<?php echo e($coin); ?> List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1><?php echo e($coin); ?> Deposit History</h1>
	</header>
	
	<div class="card">
		<div class="card-body">
		<div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>Username</th>
							<th>Txn Id</th>
							<th>Sender</th>
							<th>Recipient</th>
							<th>Amount</th>
							<th style="min-width: 250px">Reason</th>
							<?php if(in_array("read", explode(',',$AdminProfiledetails->depositlist))): ?>
							<th colspan="2">Action</th><?php endif; ?>
						</tr>
					</thead>
					<tbody>					
					<?php if($depositList->count()): ?>
					<?php 
			            $i =1;

			            $limit=10;

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
							<td><?php echo e(date('d-m-Y H:i:s', strtotime($histroy->created_at))); ?></td>
							<td><a href="<?php echo e(url('admin/users_edit/'.Crypt::encrypt($histroy->uid))); ?> "><?php echo e($histroy->user['name']); ?></a></td>
							<td><?php echo e($histroy->txid); ?></td>
							<td><?php echo e($histroy->from_addr ? $histroy->from_addr : '-'); ?></td>
							<td><?php echo e($histroy->to_addr); ?></td>
							<td><?php echo e(display_format($histroy->amount,8)); ?></td>
							<td style="white-space: normal;"><?php echo e($histroy->remark); ?></td>
							<?php if(in_array("read", explode(',',$AdminProfiledetails->depositlist))): ?>
							<td>
							<?php if($histroy->status==0): ?>
							<a class="btn btn-success btn-xs" href="<?php echo e(url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
							<?php elseif($histroy->status==2): ?>
								<a class="btn btn-success btn-xs" href="<?php echo e(url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
							<?php elseif($histroy->status==3): ?>
								Cancelled
								<?php else: ?>
								-
							<?php endif; ?> 
							</td>
							<?php endif; ?>
						</tr> 
						<?php
						    $i++;
						?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?> 
					<td colspan="15">	<?php echo e('No record found! '); ?></td>
				<?php endif; ?>
					</tbody>
				</table>
				
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    <?php if($depositList->count()): ?>
				    <?php echo e($depositList->links()); ?>

				<?php endif; ?>
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/userdeposit/crypto_deposit.blade.php ENDPATH**/ ?>