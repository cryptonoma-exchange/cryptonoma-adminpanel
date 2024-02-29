<?php
$atitle = 'dashboard';
$AdminProfiledetails = $details['AdminProfiledetails'];
?>

<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <header class="content__title">
            <h1>Dashboard</h1>
        </header>
        <form action="<?php echo e(url('/admin/userssearch')); ?>" method="post" autocomplete="off">
            <?php echo e(csrf_field()); ?>

            <div class="row searchnrow">

                <div class="col-md-3">
                    <input type="text" name="statdate" class="form-control date-picker"
                        value="<?php if(isset($details['statdate'])): ?> <?php echo e($details['statdate']); ?> <?php endif; ?>" placeholder="Start Date"
                        required="" />
                </div>

                <div class="col-md-2">
                    <input type="text" name="enddate" class="form-control date-picker"
                        value="<?php if(isset($details['enddate'])): ?> <?php echo e($details['enddate']); ?> <?php endif; ?>" placeholder="End Date"
                        required="" />
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success user_date"><i class="fa fa-search"></i> Search</button>
                    <a class="btn btn-warning btn-xs" href="<?php echo e(url('/admin/dashboard')); ?>"> <i class="fa fa-refresh"></i>
                        Clear </a>
                </div>
            </div>
        </form>
        <?php if(session('error')): ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <div class="row quick-stats listview2">

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['totalusers']); ?></h2>
                        <small>Total Users</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['kycverify']); ?></h2>
                        <small>KYC Verified Users</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['completebuytrade']); ?></h2>
                        <small>Completed buy Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-exchange"></i></h1>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['completeselltrade']); ?></h2>
                        <small>Completed Sell Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-exchange"></i></h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['chat']); ?></h2>
                        <small>Unread Support Tickets</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['blockusers']); ?></h2>
                        <small>Blockuser</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-exchange"></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['buytrade']); ?></h2>
                        <small>Pending Buy Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-shopping-cart" aria-hidden="true"></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item">
                    <div class="quick-stats__info col-md-8">
                        <h2><?php echo e($details['selltrade']); ?></h2>
                        <small>Pending Sell Trade</small>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i class="fa fa-shopping-bag" aria-hidden="true"></i></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Site Statistics</h4>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-users"></i></div>
                                <div class="widget-past-days__info"><small>Total Users</small>
                                    <h3><a href="/admin/users"><?php echo e($details['totalusers']); ?></a></h3>
                                </div>

                            </div>
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="zmdi zmdi-assignment-o"></i></div>
                                <div class="widget-past-days__info"><small>KYC Verified Users</small>
                                    <h3><a href="/admin/kyc"><?php echo e($details['kycverify']); ?></a></h3>
                                </div>

                            </div>
                        </div>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="zmdi zmdi-ticket-star"></i></div>
                                <div class="widget-past-days__info"><small>Unread Support Tickets</small>
                                    <h3><a href="/admin/support"><?php echo e($details['chat']); ?></a></h3>
                                </div>

                            </div>

                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="zmdi zmdi-block-alt zmdi-hc-fw"></i></div>
                                <div class="widget-past-days__info"><small>Blockuser</small>
                                    <h3><a href="/admin/users"><?php echo e($details['blockusers']); ?></a></h3>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Trade Statistics</h4>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-exchange"></i></div>
                                <div class="widget-past-days__info"><small>Completed Trade</small>
                                    <h3><a href="/admin/buy_tradehistory/BTC_KES/limit">
                                            <?php echo e($details['completedtrade']); ?></a></h3>
                                </div>
                            </div>
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-exchange"></i></div>
                                <div class="widget-past-days__info"><small>Total Earnings</small>
                                    <h3><a href="/admin/deposits/KES">0</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="listview listview--bordered listh">
                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-shopping-cart"></i></div>
                                <div class="widget-past-days__info"><small>Pending Buy Trade</small>
                                    <h3><a href="/admin/pending_tradehistory/all/Buy"><?php echo e($details['buytrade']); ?></a>
                                    </h3>
                                </div>
                            </div>

                            <div class="listview__item">
                                <div class="widget-past-days__chart"><i class="fa fa-shopping-bag"></i></div>
                                <div class="widget-past-days__info"><small>Pending Sell Trade</small>
                                    <h3><a href="/admin/pending_tradehistory/all/Sell"><?php echo e($details['selltrade']); ?></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php if(in_array('kyc_view', explode(',', $AdminProfiledetails->dashboard))): ?>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent KYC Submit Users (Pending)</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Date & Time</th>
                                            <th>Username</th>
                                            <th>Kyc Verify</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $details['kyc_users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kyc_users_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e(date('m-d-Y H:i:s', strtotime($kyc_users_data->created_at))); ?>

                                                </td>
                                                <td><?php echo e(username($kyc_users_data->uid)); ?></td>
                                                <td>Awaiting Confirmation </td>

                                                <td><a class="btn btn-success btn-xs"
                                                        href="<?php echo e(url('admin/kycview/' . Crypt::encrypt($kyc_users_data->kyc_id))); ?>"><i
                                                            class="zmdi zmdi-edit"></i> View </a> </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6"> No Record Found!</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(in_array('withdraw_view', explode(',', $AdminProfiledetails->dashboard))): ?>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Withdraw Request (Pending)</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Username</th>
                                            <th>Coin/Token</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($details['withdraw_request'])): ?>
                                            <?php $__currentLoopData = $details['withdraw_request']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw_requests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(date('m-d-Y H:i:s', strtotime($withdraw_requests->created_at))); ?>

                                                    </td>
                                                    <td><?php echo e($withdraw_requests->user->name); ?></td>
                                                    <td><?php echo e($withdraw_requests->currency); ?></td>
                                                    <td><?php echo e($withdraw_requests->paymenttype ? $withdraw_requests->paymenttype : "-"); ?></td>
                                                    <td><?php echo e(display_format($withdraw_requests->amount, 8, '.', '')); ?></td>
                                                    <td>Awaiting Confirmation </td>
                                                    <td>
                                                        <a class="btn btn-success btn-xs" href="<?php echo e($withdraw_requests->view_link); ?>">
                                                        <i class="zmdi zmdi-edit"></i> 
                                                        View 
                                                        </a> 
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6"> No Record Found!</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if(in_array('support_view', explode(',', $AdminProfiledetails->dashboard))): ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Support Ticket</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Username</th>
                                            <th>Ticket Id</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <?php if(in_array('write', explode(',', $AdminProfiledetails->support))): ?>
                                                <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($details['support_ticket'])): ?>
                                            <?php $__currentLoopData = $details['support_ticket']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support_tickets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(date('m-d-Y H:i:s', strtotime($support_tickets->created_at))); ?>

                                                    </td>
                                                    <td><?php echo e(username($support_tickets->uid)); ?></td>
                                                    <td><?php echo e($support_tickets->ticket_id); ?></td>
                                                    <td><?php echo e($support_tickets->subject); ?></td>
                                                    <td><?php echo e($support_tickets->message); ?></td>
                                                    <?php if(in_array('write', explode(',', $AdminProfiledetails->support))): ?>
                                                        <td><a class="btn btn-success btn-xs"
                                                                href="<?php echo e(url('/admin/reply/' . Crypt::encrypt($support_tickets->ticket_id))); ?>"><i
                                                                    class="zmdi zmdi-edit"></i> View </a> </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6"> No Record Found!</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Deposit Request (Pending)</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Username</th>
                                    <th>Coin/Token</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($details['deposit_request'])): ?>
                                    <?php $__currentLoopData = $details['deposit_request']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw_requests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(date('m-d-Y H:i:s', strtotime($withdraw_requests->created_at))); ?></td>
                                            <td><?php echo e($withdraw_requests->user->name); ?></td>
                                            <td><?php echo e($withdraw_requests->currency); ?></td>
                                            <td><?php echo e($withdraw_requests->paymenttype); ?></td>
                                            <td><?php echo e(display_format($withdraw_requests->amount, 2, '.', '')); ?></td>
                                            <td>Awaiting Confirmation </td>
                                            <?php if(in_array('write', explode(',', $AdminProfiledetails->withdrawlist))): ?>
                                                
                                                        
                                                        <td><a class="btn btn-success btn-xs"
                                                            href="<?php echo e(url('/admin/fiatdeposit_edit' . '/' . Crypt::encrypt($withdraw_requests->id))); ?>">
                                                            <i class="zmdi zmdi-edit"></i> View </a> </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6"> No Record Found!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', $details, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\cryptonoma-adminpanel\resources\views/dashboard.blade.php ENDPATH**/ ?>