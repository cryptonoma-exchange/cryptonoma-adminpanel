<?php
$atitle ="adminbank";
?>

<?php $__env->startSection('title', 'Admin Bank'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>Mpesa Details</h1>
	</header>

	<?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			
			<div class="row">
				<div class="col-md-6 tg-select-left">
				
				</div>
				<div class="col-md-6 tg-select">
					

			<?php if(count($mpesa)== 0): ?>
			<a href="<?php echo e(url('addmpesa')); ?>" class="btn btn-info pull-right">Add</a>
			<?php endif; ?>

				
				</div>
			</div>
		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.no</th>
							<th>APIkey</th>
							<th>Shortcode</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    <?php if(count($mpesa) > 0): ?>
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
						  <?php $__currentLoopData = $mpesa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mpesas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
						<tr>
							<td><?php echo e($i); ?></td>
							
							<td><?php echo substr(strip_tags( $mpesas->passkey), 0, 4); ?>******************************<?php echo substr(strip_tags(  $mpesas->passkey), -4, 4); ?></td>
							<td><?php echo e($mpesas->shortcode); ?></td>		 
							<td><a class="btn btn-success btn-xs" href="<?php echo e(url('admin/mpesa/edit')); ?>"><i class="zmdi zmdi-edit"></i> Update </a> </td>
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
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/bank/mpesa.blade.php ENDPATH**/ ?>