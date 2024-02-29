<?php $__env->startSection('title', 'Update Stage'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-panel">
    <div class="content">
        <div class="page-inner">
            
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <h2 class="d-inline">ICO/STO Stage Update</h2>
                                    <a href="<?php echo e(route('stages')); ?>" class="float-right btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Go Back</a>
                                </div>
                                <div class="col-md-8 offset-md-2">
                                    <form method="POST" action="<?php echo e(route('update.stage')); ?>">
                                        <?php echo csrf_field(); ?>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                
                                                <label for="">Select Token / Coin</label>

                                                <select class="form-control" id="token_id" name="token_id" required>

                                                    <option value=" ">Select Token / Coin</option>
                                                    
                                                    <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($coin->id); ?>" <?php echo e($stage->coin_id == $coin->id ?  "selected" : ""); ?>><?php echo e($coin->coinname); ?></option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Stage Title/Name</label>
                                                <input type="text" class="form-control" value="<?php echo e($stage->stage_name); ?>" name="stage_name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label>Total Token Issues</label>
                                            <input type="text" class="form-control" value="<?php echo e($stage->token); ?>" name="token" required>
                                            <small>Define how many tokens available for sale on stage.</small>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label>Base Token Price</label>
                                            <input type="text" class="form-control" name="price" value="<?php echo e($stage->price); ?>" required>
                                            <small>Define your token rate. Usually USD per token.</small>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label>Bonus</label>
                                            <input type="text" class="form-control" value="<?php echo e($stage->bonus); ?>" name="bonus" required>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                              <label>Min Per Transaction</label>
                                              <input type="text" class="form-control" name="min" value="<?php echo e($stage->min); ?>" required>
                                              <small>Purchase min amount of token per tranx.</small>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>Max Per Transaction</label>
                                              <input type="text" class="form-control" name="max" value="<?php echo e($stage->max); ?>" required>
                                              <small>Purchase max amount of token per tranx.</small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                              <label>Start Date</label>
                                              <input type="datetime-local" class="form-control" name="startdate" value="<?php echo e($stage->start_date); ?>" required>
                                              <small>Start date/time for sale. Can't purchase before time.</small>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>End Date</label>
                                              <input type="datetime-local" class="form-control" name="enddate" value="<?php echo e($stage->end_date); ?>" required>
                                              <small>Finish date/time for sale. Can't purchase after time.</small>
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo e($stage->id); ?>" name="stage_id">
                                        <button type="submit" class="btn btn-primary">Update Stage</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/stages/update.blade.php ENDPATH**/ ?>