<ul class="nav nav-tabs" role="tablist">
	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.edit')) active @endif" href="{{ url('/admin/users_edit/' . Crypt::encrypt($userdetails->id)) }}" role="tab">User
			Details</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.kyc')) active @endif" href="{{ url('/admin/userkyc/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Kyc</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.wallet')) active @endif" href="{{ url('/admin/users_wallet/' . Crypt::encrypt($userdetails->id)) }}"
			role="tab">Wallet</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.deposit')) active @endif" href="{{ url('/admin/userdeposit/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Coin
			Deposit</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.withdraw')) active @endif" href="{{ url('/admin/user_withdraw/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Coin
			Withdraw</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.fiat_deposit')) active @endif" href="{{ url('/admin/userfiatdeposit/' . Crypt::encrypt($userdetails->id)) }}"
			role="tab">Currency Deposit</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.fiat_withdraw')) active @endif" href="{{ url('/admin/user_fiat_withdraw/' . Crypt::encrypt($userdetails->id)) }}"
			role="tab">Currency Withdraw</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.buy_trade')) active @endif" href="{{ url('/admin/user_buy_tradehistory/' . Crypt::encrypt($userdetails->id)) }}"
			role="tab">Buy trade</a>
	</li>

	<li class="nav-item">
		<a class="nav-link @if(request()->route()->named('user.sell_trade')) active @endif" href="{{ url('/admin/user_sell_tradehistory/' . Crypt::encrypt($userdetails->id)) }}"
			role="tab">Sell trade</a>
	</li>
</ul>
