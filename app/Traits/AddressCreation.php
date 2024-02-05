<?php

namespace App\Traits;

use App\Traits\BtcClass;
use App\Traits\TokenERCClass;
use App\Models\UserWallet;
use App\Models\Commission;
use App\Traits\LtcClass;
use App\Traits\XrpClass;
use App\Traits\BchClass;

trait AddressCreation
{
	use BtcClass, TokenERCClass, LtcClass, XrpClass, BchClass;

	public function userAddressCreation($id)
	{
		$btcAddress = $this->create_user_btc($id);
		$ethAddress = $this->createEthAddress($id);
		$bnbAddress = $this->createBnbAddress($id);
		$ltcAddress = $this->create_user_ltc($id);
		$xrpAddress = $this->create_user_xrp($id);
		$bchAddress = $this->create_user_bch($id);
		$tokenAddress = $this->create_user_erctoken($id);
		$this->createfiatbalance($id);
		if (
			isset($tokenAddress) && 
			isset($btcAddress) && 
			isset($bnbAddress) && 
			isset($ethAddress) && 
			isset($ltcAddress) &&  
			isset($xrpAddress) &&  
			isset($bchAddress)
		) {
			return 1;
		} else {
			return 0;
		}
	}

	public function createfiatbalance($uid)
	{
		$oCommision = Commission::where('type', 'fiat')->get();
		foreach ($oCommision as $Commision) {
			$walletaddress = UserWallet::where(['uid' => $uid, 'currency' => $Commision->source])->first();
			if (!$walletaddress) {
				$walletaddress = new UserWallet;
				$walletaddress->uid = $uid;
				$walletaddress->currency = $Commision->source;
				$walletaddress->save();
			}
		}
	}
}
