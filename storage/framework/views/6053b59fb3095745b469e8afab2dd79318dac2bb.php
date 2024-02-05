<?php echo $__env->make('email.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>

<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Dear <?php echo e($user->name); ?>,</td><td align='left	'>&nbsp;</td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Your KYC Accepted successfully. Please Login and continue to trade</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<?php echo $__env->make('email.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/email/adminaccept_kyc.blade.php ENDPATH**/ ?>