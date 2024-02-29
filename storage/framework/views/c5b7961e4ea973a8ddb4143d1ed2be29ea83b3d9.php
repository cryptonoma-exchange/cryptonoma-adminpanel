<?php $__env->startSection('title', 'Time Settings'); ?>
<?php $__env->startSection('content'); ?>


<section class="content">
    <header class="content__title">
        <h1>Time Settings</h1>
    </header>


    <div class="row">

        <div class="col-lg-12 text-right text-end mb-2">
            
            <button class="btn btn-primary btn-md cuModalBtn" data-modal_title="<?php echo app('translator')->getFromJson('Add New Time'); ?>">
        <i class="las la-plus"></i> <?php echo app('translator')->getFromJson('Add New'); ?>
    </button>

        </div>

        <div class="col-lg-12">

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>


                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
    

            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('S.N.'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-label="<?php echo app('translator')->getFromJson('S.N.'); ?>"><?php echo e($loop->iteration); ?></td>
                                        <td data-label="<?php echo app('translator')->getFromJson('Name'); ?>"><?php echo e(__($time->name)); ?></td>
                                        <td data-label="<?php echo app('translator')->getFromJson('Time'); ?>"><?php echo e(__($time->time)); ?> <?php echo app('translator')->getFromJson('Hours'); ?></td>
                                        <td data-label="<?php echo app('translator')->getFromJson('Action'); ?>">
                                            <button class="btn btn-sm btn-primary cuModalBtn" data-modal_title="<?php echo app('translator')->getFromJson('Update Time'); ?>" data-resource="<?php echo e($time); ?>"><i class="las la-pen text--shadow"></i><?php echo app('translator')->getFromJson('Edit'); ?></button>

                                            <button class="btn btn-sm btn-danger removeBtn" data-toggle="modal" data-target="#removeModal" data-id="<?php echo e($time->id); ?>"><i class="las la-trash text--shadow"></i><?php echo app('translator')->getFromJson('Delete'); ?></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

</section>    

    <div class="modal fade" id="cuModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close bg-danger text-white" data-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form action="<?php echo e(route('admin.times.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->getFromJson('Name'); ?></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->getFromJson('Hour'); ?></label>
                            <div class="input-group">
                                <input type="text" name="time" class="form-control" required>
                                <span class="input-group-text"><?php echo app('translator')->getFromJson('Hour'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-block"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->getFromJson('Delete Time'); ?></h5>
                <button type="button" class="close bg-danger text-white" data-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="<?php echo e(route('admin.times.delete')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <h6><?php echo app('translator')->getFromJson('Are you sure to delete this time?'); ?></h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-dark"><?php echo app('translator')->getFromJson('No'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('Yes'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('child-scripts'); ?>
<script>
    (function($){
        "use strict";
        $('.removeBtn').on('click',function () {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'));
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/times/index.blade.php ENDPATH**/ ?>