<?php
$atitle ="bittrex";
?>

<?php $__env->startSection('title', 'Bittrex Admin Wallet'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Admin Wallet</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <th>Commission</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($coin->source); ?></td>
                    <td><?php echo e($coin->balance); ?></td>
                  </tr>                  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/admin/adminwallet.blade.php ENDPATH**/ ?>