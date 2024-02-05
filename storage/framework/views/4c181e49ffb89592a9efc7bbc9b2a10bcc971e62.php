<?php
$atitle ="cms";
?>

<?php $__env->startSection('title', 'How Its Works Settings - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>How It Works</h1>
    </header>
    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="<?php echo e(url('admin\howitworks_update')); ?>">
        <?php echo e(csrf_field()); ?>

          <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Heading</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="heading[]" class="form-control" value="<?php echo e($new->title); ?>">
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="description[]" class="form-control" value="<?php echo e($new->desc); ?>" >
                  <i class="form-group__bar"></i> </div>
              </div>
            </div> 
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <button type="submit" class="btn btn-md btn-warning">Update</button>
              </div>
            </div>
            <div class="col-md-4">
               
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
  <?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/settings/howitworks.blade.php ENDPATH**/ ?>