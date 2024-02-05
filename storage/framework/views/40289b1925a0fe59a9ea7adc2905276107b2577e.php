<?php echo $__env->make('email.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Dear <?php echo e($user->name); ?>,</td><td align='left'>&nbsp;</td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Your KYC Rejected .</td><td align='left'>&nbsp;</td></tr>
<?php if(!empty($remark->remark)): ?>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Reason for rejection is <?php echo e($remark->remark); ?></td><td align='left'>&nbsp;</td></tr>
<?php endif; ?>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Please Login and fill your kyc form again</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<?php echo $__env->make('email.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/email/adminreject_kyc.blade.php ENDPATH**/ ?>