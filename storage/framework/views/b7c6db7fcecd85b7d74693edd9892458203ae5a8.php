<?php
$atitle = 'support';
?>

<?php $__env->startSection('title', 'Support Ticket'); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <header class="content__title">
            <h1>Support</h1>
        </header>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Date & Time</th>
                                <th>Ticket Id</th>
                                <th>Username</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <?php if(in_array('read', explode(',', $AdminProfiledetails->support))): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                                <th>Unread message</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                $limit = 10;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    $i = $limit * $page - $limit + 1;
                                } else {
                                    $i = 1;
                                }
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e(date('d-m-Y H:i:s', strtotime($ticket->created_at))); ?></td>
                                    <td><?php echo e($ticket->ticket_id); ?></td>
                                    <td><?php echo e($ticket->name); ?></td>
                                    <td><?php echo e(mb_strimwidth($ticket->subject, 0, 50, '...')); ?></td>
                                    <td class="msglistcnt"><?php echo e(mb_strimwidth($ticket->message, 0, 50, '...')); ?></td>
                                    <td><?php if($ticket->status == 0): ?> Running <?php else: ?> Completed <?php endif; ?></td>
                                    <?php if(in_array('read', explode(',', $AdminProfiledetails->support))): ?>
                                        <td><a class="btn btn-primary btn-xs"
                                                href="<?php echo e(url('/admin/reply/' . Crypt::encrypt($ticket->ticket_id))); ?>"
                                                class="btn btn-info">Chat</a>
                                            <?php if($ticket->status == 0): ?>
                                                <span data-toggle="tooltip" title="Mark as Complete">
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#confirm-enable"
                                                        data-href="<?php echo e(url('/admin/completeChat/' . Crypt::encrypt($ticket->id))); ?>"><i
                                                            class="fa fa-check"></i> </a>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <td><?php echo e($ticket->admin_unreadmsg($ticket->ticket_id)); ?></td>
                                </tr>
                                <?php
                                    $i++;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7"> No record found!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    <div class="pagination-tt clearfix">
                        <?php if($tickets->count()): ?>
                            <?php echo e($tickets->links()); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> Delete </div>
                    <div class="modal-body"> Are you sure you want to delete this user? </div>
                    <div class="modal-footer"> <a class="btn btn-danger btn-ok">Yes</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade site-modal" id="confirm-enable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Complete Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body text-black">
                        Are you sure, do you want to complete this chat?
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ok">Yes</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/support/list.blade.php ENDPATH**/ ?>