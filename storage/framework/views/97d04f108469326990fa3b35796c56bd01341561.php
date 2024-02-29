<?php
$atitle ="users";
?>

<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>Users</h1>
	</header>
	<div class="card">
		<div class="card-body">


			  <?php if($message = Session::get('updated_status')): ?>
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>

            
		    <form action="<?php echo e(url('/admin/users/search')); ?>" method="get" autocomplete="off">
				<?php echo e(csrf_field()); ?>

				<div class="row">
					<div class="col-md-3">                
						<input type="text" name="searchitem" class="form-control" placeholder="Search for Username or Email" value= "" required=""/>
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="<?php echo e(url('admin/users')); ?>"> Reset </a> 
					</div>
					</form>
					<!-- <div class="col-md-3">
						<input type="button" id="btnExport" class="btn btn-success user_date" value="Export To Excel" />  

					</div> -->
				</div>
			
			<br/>

			<div class="table-responsive search_result">
				<table class="table">
					<thead>
						<tr>
							<th>Account No </th>
							<th>Date and Time</th>
							<th>Username</th>
							<th>Email Id</th>
							<th>Email Verify</th>
							<th>Kyc Verify</th>
							<th colspan="1">Action</th>
						</tr>
					</thead>
					<tbody>					    
					    <?php 
			            $i =1;

			            $limit=100;

			            if(isset($_GET['page'])){
							$page = $_GET['page'];
							$i = (($limit * $page) - $limit)+1;
						}else{
						  $i =1;
						}        
						?>
					<?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<tr>
							<td><?php echo e($user->account_number); ?></td></td>
							<td><?php echo e(date('Y/m/d h:i:s', strtotime($user->created_at))); ?></td>
							<td><?php echo e($user->name); ?></td>
							<td><?php echo e($user->email); ?></td>
							<td><?php if($user->email_verify == 1): ?> Yes <?php elseif($user->email_verify == 2): ?> Waiting <?php else: ?> No <?php endif; ?></td>
							<td><?php if($user->kyc_verify == 1): ?> Yes <?php elseif($user->kyc_verify == 2): ?> Waiting <?php else: ?> No <?php endif; ?></td>
							<td><a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/users_edit/'.Crypt::encrypt($user->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a></td>

						</tr>
						 <?php
				         $i++;
				         ?>				
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					    <tr><td colspan="7"> No record found!</td></tr>
					<?php endif; ?>
					</tbody>
				</table>


					<table class="table" id="dvData" style="display: none;">
					<thead>
						<tr>
							<th>S.NO </th>
							<th>Name</th>
							<th>Email ID</th>
							<th>Phone number</th>
						</tr>
					</thead>
					<tbody>					    
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
					<?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<tr>
							<td><?php echo e($i); ?></td>
							<td><?php echo e($user->name); ?></td>
							<td><?php echo e($user->email); ?></td>
							<td><?php echo e($user->phone_no ? $user->phone_no : '-'); ?></td>
						</tr>
						 <?php
				         $i++;
				         ?>				
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					    <tr><td colspan="7"> No record found!</td></tr>
					<?php endif; ?>
					</tbody>
				</table>

				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
         

				   <?php if(count($details) > 0): ?>
                            <?php echo $details->appends(Request::only(['searchitem'=>'searchitem']))->render(); ?> 
                    <?php endif; ?>

                </div>
              </div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?> 
    

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/user/users.blade.php ENDPATH**/ ?>