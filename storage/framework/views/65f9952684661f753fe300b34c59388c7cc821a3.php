<?php $__env->startSection('title', 'Coins Setting'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Tokens</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
                    <a href="<?php echo e(url('/admin/addcoin')); ?>" class="btn btn-info">Add Token</a>

              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Token Symbol</th>
                    <th>Network</th>
                    <th>Token Name</th>
                    <th>Contract Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                <?php $__empty_1 = true; $__currentLoopData = $networks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $network): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($loop->index + $networks->firstItem()); ?></td>
                    <td><?php echo e($network->coin->source); ?></td>
                    <td><?php echo e($network->network); ?></td>
                    <td><?php echo e($network->coin->coinname); ?></td>
                    <td><?php echo e($network->contractaddress); ?></td>                    
                    <td><a href="<?php echo e(url('/admin/coinsettings', Crypt::encrypt($network->id))); ?>" class="btn btn-info">View / Edit</a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                   <tr><td colspan="7"> <?php echo e('No List Settings'); ?>!</td></tr>
                <?php endif; ?>
                </tbody>
              </table>
              <?php echo e($networks->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/tradepair/commission.blade.php ENDPATH**/ ?>