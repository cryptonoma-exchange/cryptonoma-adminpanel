<?php
$atitle = 'deposit';
?>

<?php $__env->startSection('title', 'Withdraw History'); ?>
<?php $__env->startSection('content'); ?>
	<section class="content">
		<header class="content__title">
			<h1> <?php echo e($coin); ?> Deposit History</h1>
		</header>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive search_result">
							<table class="table" id="dows">

								<thead>
									<tr>
										<th>S.No</th>
										<th>Date & Time</th>
										<th>Withdraw Type</th>
										<th>Username</th>
										<th>Txn Id</th>
										<th>Deposited Amount (<?php echo e($coin); ?>)</th>
										<th>Credit Amount (<?php echo e($coin); ?>)</th>
										<th style="min-width: 250px">Reason</th>
										<th>Status</th>
										<?php if(in_array('write', explode(',', $AdminProfiledetails->depositlist))): ?>
											<th>Action</th>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php if(count($deposit) > 0): ?>
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
										<?php $__currentLoopData = $deposit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($i); ?></td>
												<td><?php echo e(date('Y-m-d h:i:s', strtotime($transactions->created_at))); ?></td>
												<td><?php echo e($transactions->paymenttype); ?></td>
												<td><?php echo e(username($transactions->uid)); ?></td>
												<td><?php echo e($transactions->txid ? $transactions->txid : '-'); ?></td>
												<td><?php echo e(display_format($transactions->amount, 8)); ?></td>
												<td><?php echo e(display_format($transactions->credit_amount, 8)); ?></td>
												<td style="white-space: normal;"><?php echo e($transactions->remark); ?></td>
												<td>
													<?php if($transactions->paymenttype == 'tinypesa'): ?>
														<?php if($transactions->status == 0): ?>
															Pending
														<?php elseif($transactions->status == 2): ?>
															Failed
														<?php elseif($transactions->status == 3): ?>
															<?php echo app('translator')->getFromJson('common.Cancelled by user'); ?>
														<?php else: ?>
															Success
														<?php endif; ?>
													<?php else: ?>
														<?php if($transactions->status == 0): ?>
															Waiting for admin confirmation
														<?php elseif($transactions->status == 2): ?>
															Rejected by admin
														<?php elseif($transactions->status == 3): ?>
															Cancelled by user
														<?php else: ?>
															Approved by admin
														<?php endif; ?>
													<?php endif; ?>
												</td>
												<?php if(in_array('write', explode(',', $AdminProfiledetails->depositlist))): ?>
													<td>
														<?php if($transactions->paymenttype == 'tinypesa'): ?>
															--
														<?php elseif($transactions->status == 0): ?>
															<a class="btn btn-success btn-xs"
																href="<?php echo e(url('/admin/fiatdeposit_edit/' . Crypt::encrypt($transactions->id))); ?>"><i
																	class="zmdi zmdi-edit"></i> View </a>
														<?php else: ?>
															--
														<?php endif; ?>

													</td>
												<?php endif; ?>
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
							<?php if(count($deposit) > 0): ?>
								<?php echo e($deposit->links()); ?>

							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/userdeposit/fiat_deposit.blade.php ENDPATH**/ ?>