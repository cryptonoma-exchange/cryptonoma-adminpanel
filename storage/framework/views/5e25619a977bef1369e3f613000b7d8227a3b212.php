<?php
$atitle = 'adminbank';
?>

<?php $__env->startSection('title', 'Admin Bank'); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <header class="content__title">
            <h1><?php echo e($fiat); ?> Admin Bank Details</h1>
        </header>

        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 tg-select-left">

                            </div>
                            <div class="col-md-6 tg-select">


                                <?php if(count($bank) == 0): ?>
                                    <a href="<?php echo e(url('/admin/addbank/' . $fiat)); ?>" class="btn btn-info pull-right">Add</a>
                                <?php endif; ?>


                            </div>
                        </div>
                        <div class="table-responsive search_result">
                            <table class="table" id="dows">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date & Time</th>
                                        <th>Currency Name</th>
                                        <th>Bank Name</th>
                                        <th>Account No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($bank) > 0): ?>
                                        <?php
                                            $i = 1;
                                            $limit = 15;
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                                $i = $limit * $page - $limit + 1;
                                            } else {
                                                $i = 1;
                                            }
                                        ?>
                                        <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin_banks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <tr>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e(date('Y/m/d h:i:s', strtotime($admin_banks->created_at))); ?></td>
                                                <td><?php echo e($admin_banks->currency); ?></td>
                                                <td><?php echo e($admin_banks->bank_name); ?></td>
                                                <td><?php echo e($admin_banks->account_no); ?></td>
                                                <td><a class="btn btn-success btn-xs"
                                                        href="<?php echo e(url('/admin/edit_bank/' . Crypt::encrypt($admin_banks->id) . '/' . $fiat)); ?>"><i
                                                            class="zmdi zmdi-edit"></i> Update </a> </td>
                                            </tr>
                                            <?php
                                                $i++;
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7"> No record found!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/bank/list.blade.php ENDPATH**/ ?>