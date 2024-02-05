<?php
    $atitle = 'users';
?>

<?php $__env->startSection('title', ' Users Wallet'); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <header class="content__title">
            <h1>User Wallet</h1>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <a href="<?php echo e(url('admin/users')); ?>"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                        <br><br>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>


                        <?php if(session('error')): ?>
                            <div class="alert alert-warning">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="tab-container">

                            <?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <br>
                        </div>
                        <br>
                        <form action="<?php echo e(url('/admin/Balance_update')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php if($coin->type != 'fiat'): ?>
                                                <label><?php echo e($coin->source); ?> Address</label>
                                            <?php else: ?>
                                                <label><?php echo e($coin->source); ?> Balance</label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if($coin->type != 'fiat'): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php $__currentLoopData = $coin->networks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $network): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label for="exampleInputEmail1"><?php echo e($network->network); ?></label>
                                                    <?php if($network->address != ''): ?>
                                                    <input type="text" name="from_address" class="form-control"
                                                        value="<?php echo e($network->address); ?>" readonly><i
                                                        class="form-group__bar"></i>
                                                    <?php else: ?>
                                                        <input type="text" name="from_address" class="form-control"
                                                            value="No Address" readonly><i class="form-group__bar"></i>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php if($coin->balance > 0): ?>
                                                <?php if($coin->source == 'KES'): ?>
                                                    <input type="number" name="balance_<?php echo e($coin->source); ?>"
                                                        class="form-control"
                                                        value="<?php echo e(display_format($coin->balance,2)); ?>"
                                                        step="0.00001" min="0" max="100000000" readonly><i
                                                        class="form-group__bar"></i>
                                                <?php else: ?>
                                                    <input type="number" name="balance_<?php echo e($coin->source); ?>"
                                                        class="form-control"
                                                        value="<?php echo e($coin->balance); ?>" step="0.00001"
                                                        min="0" max="100000000" readonly><i
                                                        class="form-group__bar"></i>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <input type="number" name="balance_<?php echo e($coin->source); ?>"
                                                    class="form-control" value="0" step="0.00001" min="0"
                                                    max="100000000" readonly><i class="form-group__bar"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                        <div>
                            <h4>Add Balance:</h4>
                            <form action="<?php echo e(url('/admin/Balance_update')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>


                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Coin/Currency</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <select class="form-control" name="coin" required>
                                                <option value="">Select Coin/Currency</option>
                                                <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($coin->source); ?>"><?php echo e($coin->source); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('coin')): ?>
                                                <span class="help-block error-msg">
                                                    <strong><?php echo e($errors->first('coin')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="number" name="amount" class="form-control" value=""
                                                required step="any" min="0" max="100000000"><i
                                                class="form-group__bar"></i>
                                            <input type="hidden" name="uid" value="<?php echo e($userdetails->id); ?>">

                                            <?php if($errors->has('amount')): ?>
                                                <span class="help-block error-msg">
                                                    <strong><?php echo e($errors->first('amount')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Reason</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="reason" class="form-control" value=""
                                                required><i class="form-group__bar"></i>
                                            <?php if($errors->has('reason')): ?>
                                                <span class="help-block error-msg">
                                                    <strong><?php echo e($errors->first('reason')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-success btn-xs" type="submit" name="submit" value="submit">

                            </form>
                        </div>
                        <div>
                            <h4>Reduce Balance:</h4>
                            <form action="<?php echo e(url('/admin/Balance_reduce')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Coin/Currency</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <select class="form-control" name="coin" required>
                                                <option value="">Select Coin/Currency</option>
                                                <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($coin->source); ?>"><?php echo e($coin->source); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('coin')): ?>
                                                <span class="help-block error-msg">
                                                    <strong><?php echo e($errors->first('coin')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="number" name="amount" class="form-control" value=""
                                                required step="any" min="0" max="100000000"><i
                                                class="form-group__bar"></i>
                                            <input type="hidden" name="uid" value="<?php echo e($userdetails->id); ?>">

                                            <?php if($errors->has('amount')): ?>
                                                <span class="help-block error-msg">
                                                    <strong><?php echo e($errors->first('amount')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Reason</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="reason" class="form-control" value=""
                                                required><i class="form-group__bar"></i>
                                            <?php if($errors->has('reason')): ?>
                                                <span class="help-block error-msg">
                                                    <strong><?php echo e($errors->first('reason')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-success btn-xs" type="submit" name="submit" value="submit">

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/wallet.blade.php ENDPATH**/ ?>