<?php $__env->startSection('title', 'Referral Level'); ?>
<?php $__env->startSection('content'); ?>

<section class="content">
    <header class="content__title">
        <h1>Referral Levels</h1>
    </header>

<div class="row">

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

    </div>

    <?php $__currentLoopData = $commissionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-4 mb-4">
        <div class="card border--primary parent">
            <div class="card-header bg--primary">
                <h5 class="text-dark float-start" style="color:#000;"><?php echo e(__($type)); ?>


                     <?php if($general->$key == 0): ?>
                    <a href="<?php echo e(route('admin.setting.referral.status',$key)); ?>" class="btn btn-success btn-sm text-end text-right float-right"><i class="las la-toggle-on"></i> <?php echo app('translator')->getFromJson('Enable Now'); ?></a>
                    <?php else: ?>
                    <a href="<?php echo e(route('admin.setting.referral.status',$key)); ?>" class="btn btn-danger btn-sm text-end text-right float-right"><i class="las la-toggle-off"></i> <?php echo app('translator')->getFromJson('Disable Now'); ?></a>
                    <?php endif; ?>

                </h5>
               
            </div>

            <div class="card-body">

                <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $referrals->where('commission_type',$key); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex flex-wrap justify-content-between text-dark text-inverse">
                        <span class="fw-bold text-dark text-inverse" style="color:#000;"><?php echo app('translator')->getFromJson('Level'); ?> <?php echo e($referral->level); ?></span>
                        <span class="fw-bold text-dark text-inverse" style="color:#000;"><?php echo e($referral->percent); ?>%</span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <div class="form-group">
                    <label><?php echo app('translator')->getFromJson('Number of Level'); ?></label>
                    <div class="input-group">
                        <input type="number" name="level" min="1" placeholder="Type a number & hit ENTER ↵" class="form-control">
                        <button type="button" class="btn btn--primary generate"><?php echo app('translator')->getFromJson('Generate'); ?></button>
                    </div>
                    <span class="text--danger required-message d-none"><?php echo app('translator')->getFromJson('Please enter a number'); ?></span>
                </div>

                <form action="<?php echo e(route('admin.setting.referral.store.level')); ?>" method="post" class="d-none levelForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="commission_type" value="<?php echo e($key); ?>">
                        <h6 class="text--danger mb-3"><?php echo app('translator')->getFromJson('The Old setting will be removed after generating new'); ?></h6>
                        <div class="form-group">
                            <div class="referralLevels"></div>
                        </div>
                    <button type="submit" class="btn btn--primary btn-block"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                </form>

            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('child-scripts'); ?>
    <script>
    (function($){
        "use strict"

        $('[name="level"]').on('focus', function(){
            $(this).on('keyup', function(e){
                if(e.which == 13){
                    generrateLevels($(this));
                }
            });
        });

        $(".generate").on('click', function () {
            let $this = $(this).parents('.card-body').find('[name="level"]');
            generrateLevels($this);
        });

        $(document).on('click', '.deleteBtn', function () {
            $(this).closest('.input-group').remove();
        });

        function generrateLevels($this){
            let numberOfLevel = $this.val();
            let parent = $this.parents('.card-body');
            let html = '';
            if (numberOfLevel && numberOfLevel > 0){
                parent.find('.levelForm').removeClass('d-none');
                parent.find('.required-message').addClass('d-none');

                for (var i = 1; i <= numberOfLevel; i++){
                    html += `
                    <div class="input-group mb-3">
                        <span class="input-group-text justify-content-center"><?php echo app('translator')->getFromJson('Level'); ?>`+i+`</span>
                        <input type="hidden" name="level[]" value="`+i+`" required>
                        <input name="percent[]" class="form-control col-10" type="text" required placeholder="<?php echo app('translator')->getFromJson('Level `+i+` Commission Percentage'); ?>">
                        <button class="btn btn-danger input-group-text deleteBtn" type="button"><i class=\'zmdi zmdi-delete\'></i></button>
                    </div>`
                }

                parent.find('.referralLevels').html(html);
            }else {
                parent.find('.levelForm').addClass('d-none');
                parent.find('.required-message').removeClass('d-none');
            }
        }

    })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/referral/index.blade.php ENDPATH**/ ?>