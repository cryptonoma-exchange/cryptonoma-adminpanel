<?php
$atitle ="tradepair";
?>

<?php $__env->startSection('title', 'Trade pair Setting'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Trade pairs</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
                   
               <a href="<?php echo e(url('/admin/addpair')); ?>" class="btn btn-info">Add</a>
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin One</th>
                    <th>Coin Two</th>
                    <th>Status</th>
                    <th>Action</th>
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
                <?php $__empty_1 = true; $__currentLoopData = $tradepair; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($i); ?></td>
                    <td><?php echo e($value->coinone); ?></td>
                    <td><?php echo e($value->cointwo); ?></td>
                    <td><?php echo e($value->active == 1 ? 'Active' : 'Deactive'); ?></td>
                    <td><a href="<?php echo e(url('/admin/pairedit', Crypt::encrypt($value->id))); ?>" class="btn btn-info">View / Edit</a></td>                    
                  </tr>
                  <?php $i++; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                   <tr><td colspan="7"> <?php echo e('No List Settings'); ?>!</td></tr>
                <?php endif; ?>
                </tbody>
              </table>
              <?php echo e($tradepair->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/tradepair/tradepair.blade.php ENDPATH**/ ?>