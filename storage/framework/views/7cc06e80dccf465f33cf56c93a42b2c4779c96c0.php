<ul class="nav nav-tabs" role="tablist">
	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.edit')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/users_edit/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">User
			Details</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.kyc')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/userkyc/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Kyc</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.wallet')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/users_wallet/' . Crypt::encrypt($userdetails->id))); ?>"
			role="tab">Wallet</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.deposit')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/userdeposit/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin
			Deposit</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.withdraw')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/user_withdraw/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin
			Withdraw</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.fiat_deposit')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/userfiatdeposit/' . Crypt::encrypt($userdetails->id))); ?>"
			role="tab">Currency Deposit</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.fiat_withdraw')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/user_fiat_withdraw/' . Crypt::encrypt($userdetails->id))); ?>"
			role="tab">Currency Withdraw</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.buy_trade')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/user_buy_tradehistory/' . Crypt::encrypt($userdetails->id))); ?>"
			role="tab">Buy trade</a>
	</li>

	<li class="nav-item">
		<a class="nav-link <?php if(request()->route()->named('user.sell_trade')): ?> active <?php endif; ?>" href="<?php echo e(url('/admin/user_sell_tradehistory/' . Crypt::encrypt($userdetails->id))); ?>"
			role="tab">Sell trade</a>
	</li>
</ul>
<?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/menu.blade.php ENDPATH**/ ?>