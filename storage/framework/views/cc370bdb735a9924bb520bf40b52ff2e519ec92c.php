<?php $__env->startSection('title', 'Plans'); ?>
<?php $__env->startSection('content'); ?>

<section class="content">
    <header class="content__title">
        <h1>All Plans</h1>
    </header>

    <div class="row mt-5">
        <div class="col-lg-12 float-end text-end text-right mb-2">
             <button class="btn btn-primary btn-md modalShow float-end text-end text-right" data-type="add" data-toggle="modal" data-target="#addModal"><i class="las la-plus"></i> <?php echo app('translator')->getFromJson('Add New'); ?></button>
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
                                    <th><?php echo app('translator')->getFromJson('Name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Invest Amount'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Interest'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Status'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->getFromJson('Name'); ?>"><?php echo e(__($plan->name)); ?></td>
                                    <td data-label="<?php echo app('translator')->getFromJson('Invest Amount'); ?>">
                                        <?php if($plan->fixed_amount > 0): ?>
                                        <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->fixed_amount)); ?>

                                        <?php else: ?>
                                        <span class="text--primary"><?php echo app('translator')->getFromJson('Minimum'); ?>:</span> <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->minimum)); ?>

                                        <br>
                                        <span class="text--primary"><?php echo app('translator')->getFromJson('Maximum'); ?>:</span> <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->maximum)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->getFromJson('Interest'); ?>">
                                        <?php echo e(showAmount($plan->interest)); ?> <?php if($plan->interest_type == 1): ?> % <?php else: ?> <?php echo e($general->cur_text); ?> <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->getFromJson('Time'); ?>"><?php echo e($plan->time); ?> <?php echo app('translator')->getFromJson('Hours'); ?></td>
                                    <td data-label="<?php echo app('translator')->getFromJson('Status'); ?>">
                                        <?php if($plan->status == 1): ?>
                                            <span class="badge badge-success"><?php echo app('translator')->getFromJson('Enabled'); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php echo app('translator')->getFromJson('Disabled'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->getFromJson('Action'); ?>">
                                        <button class="btn btn-sm btn-primary modalShow" data-type="edit" data-toggle="modal" data-target="#editModal" data-resource="<?php echo e($plan); ?>" data-action="<?php echo e(route('admin.plans.update',$plan->id)); ?>"><i class="las la-pen"></i> <?php echo app('translator')->getFromJson('Edit'); ?></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e($emptyMessage); ?></td>
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

    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->getFromJson('Add New Plan'); ?></h5>
                <button type="button" class="close bg--danger text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
                </div>
                <form action="<?php echo e(route('admin.plans.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Name'); ?></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Invest type'); ?></label>
                                    <select name="invest_type" class="form-control" required>
                                        <option value="1"><?php echo app('translator')->getFromJson('Range'); ?></option>
                                        <option value="2"><?php echo app('translator')->getFromJson('Fixed'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row amount-fields"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Interest type'); ?></label>
                                    <select name="interest_type" class="form-control" required>
                                        <option value="1"><?php echo app('translator')->getFromJson('Percent'); ?></option>
                                        <option value="2"><?php echo app('translator')->getFromJson('Fixed'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Interest'); ?></label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="interest" required>
                                        <span class="input-group-text interest-type"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Time'); ?></label>
                                    <select name="time" class="form-control" required>
                                        <option value=""><?php echo app('translator')->getFromJson('Select One'); ?></option>
                                        <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($time->time); ?>"><?php echo e(__($time->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Return type'); ?></label>
                                    <select name="return_type" class="form-control" required>
                                        <option value="1"><?php echo app('translator')->getFromJson('Lifetime'); ?></option>
                                        <option value="2"><?php echo app('translator')->getFromJson('Repeat'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="repeat-time row"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-block"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->getFromJson('Edit Plan'); ?></h5>
                    <button type="button" class="close bg--danger text-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Name'); ?></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Invest type'); ?></label>
                                    <select name="invest_type" class="form-control" required>
                                        <option value="1"><?php echo app('translator')->getFromJson('Range'); ?></option>
                                        <option value="2"><?php echo app('translator')->getFromJson('Fixed'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row amount-fields"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Interest type'); ?></label>
                                    <select name="interest_type" class="form-control" required>
                                        <option value="1"><?php echo app('translator')->getFromJson('Percent'); ?></option>
                                        <option value="2"><?php echo app('translator')->getFromJson('Fixed'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Interest'); ?></label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="interest" required>
                                        <span class="input-group-text interest-type"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Time'); ?></label>
                                    <select name="time" class="form-control" required>
                                        <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($time->time); ?>"><?php echo e(__($time->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('Return type'); ?></label>
                                    <select name="return_type" class="form-control" required>
                                        <option value="1"><?php echo app('translator')->getFromJson('Lifetime'); ?></option>
                                        <option value="2"><?php echo app('translator')->getFromJson('Repeat'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="repeat-time row"></div>
                        <div class="form-group">
                            <label for="inputName"><?php echo app('translator')->getFromJson('Status'); ?> </label>
                            <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->getFromJson('Enable'); ?>" data-off="<?php echo app('translator')->getFromJson('Disable'); ?>" name="status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-block"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('child-scripts'); ?>
    <script>
        (function($){
            "use strict"

            $('.modalShow').on('click',function(){

                //get modal element
                if($(this).data('type') == 'add'){
                    var modal = $('#addModal');
                }else{
                    var modal = $('#editModal');
                }
                var plan = new HyipPlan(modal, $(this));

                modal.find('[name=invest_type]').change(function() {
                    plan.getInvestType($(this).val());
                }).change()

                modal.find('[name=interest_type]').change(function() {
                    plan.getInterestType($(this).val());
                }).change()

                modal.find('[name=return_type]').change(function() {
                    plan.getReturnType($(this).val());
                }).change()

                plan.setupEditModal();

            });


            class HyipPlan{
                constructor(modal,btn){
                    this.modal = modal;
                    this.btn = btn;
                    this.resource = btn.data('resource');
                    this.action = btn.data('action');

                    //this block for edit modal
                    if(this.resource){
                        //set amount
                        if(this.resource.fixed_amount <= 0){
                            this.modal.find('[name=invest_type]').val(1);
                        }else{
                            this.modal.find('[name=invest_type]').val(2);
                        }

                        //set interest type
                        if(this.resource.interest_type == 1){
                            this.modal.find('[name=interest_type]').val(1);
                        }else{
                            this.modal.find('[name=interest_type]').val(2);
                        }

                        //set repeat type
                        if(this.resource.life_time == 1){
                            this.modal.find('[name=return_type]').val(1);
                        }else{
                            this.modal.find('[name=return_type]').val(2);
                        }
                    }
                }

                getInvestType(type){
                    if(type == 1){
                        var html = `
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required"><?php echo app('translator')->getFromJson('Minimum Invest'); ?></label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="minimum" required>
                                        <span class="input-group-text"><?php echo e($general->cur_text); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required"><?php echo app('translator')->getFromJson('Maximum Invest'); ?></label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="maximum" required>
                                        <span class="input-group-text"><?php echo e($general->cur_text); ?></span>
                                    </div>
                                </div>
                            </div>
                            `;
                    }else{
                        var html = `
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required"><?php echo app('translator')->getFromJson('Amount'); ?></label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="amount" required>
                                        <span class="input-group-text"><?php echo e($general->cur_text); ?></span>
                                    </div>
                                </div>
                            </div>
                            `;
                    }

                    this.modal.find('.amount-fields').html(html);
                }

                getInterestType(type){
                    console.log(type);
                    if(type == 1){
                        this.modal.find('.interest-type').text('%');
                    }else{
                        this.modal.find('.interest-type').text('<?php echo e($general->cur_text); ?>');
                    }
                }

                getReturnType(type){
                    var html = ``;
                    if(type == 2){
                        var html = `
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required"><?php echo app('translator')->getFromJson('Repeat Times'); ?></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="repeat_time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('Capital back'); ?></label>
                                <select name="capital_back" class="form-control" required>
                                    <option value="1"><?php echo app('translator')->getFromJson('Yes'); ?></option>
                                    <option value="0"><?php echo app('translator')->getFromJson('No'); ?></option>
                                </select>
                            </div>
                        </div>
                        `;
                    }
                    this.modal.find('.repeat-time').html(html);
                }

                setupEditModal(){
                    var modal = this.modal;
                    var resource = this.resource;
                    if(resource){
                        modal.find('[name=name]').val(resource.name);
                        modal.find('[name=minimum]').val(parseFloat(resource.minimum).toFixed(2));
                        modal.find('[name=maximum]').val(parseFloat(resource.maximum).toFixed(2));
                        modal.find('[name=amount]').val(parseFloat(resource.fixed_amount).toFixed(2));
                        modal.find('[name=interest]').val(parseFloat(resource.interest).toFixed(2));
                        modal.find('[name=time]').val(resource.time);
                        modal.find('[name=repeat_time]').val(resource.repeat_time);
                        modal.find('[name=capital_back]').val(resource.capital_back);
                        modal.find('form').attr('action',this.btn.data('action'));
                        if (resource.status == 1) {
                            modal.find('[name=status]').bootstrapToggle('on');
                        } else {
                            modal.find('[name=status]').bootstrapToggle('off');
                        }
                    }
                }
            }

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/plan/index.blade.php ENDPATH**/ ?>