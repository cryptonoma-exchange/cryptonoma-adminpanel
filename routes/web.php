<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AdminLoginController@index');

Route::post('login', 'AdminLoginController@login');
Route::get('logout', 'AdminLoginController@logout');
Route::get('Bdru_adress_create', 'CronController@Bdru_adress_create');
Route::any('/tinypesa_callback', 'MpesaController@tinypesa_callback');
//2fa
Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	//google 2FA 
	Route::get('/googe2faenable', 'TwofaController@enableGoogleTwoFactor')->name('googe2faenable');
	Route::post('/google_admin_verfiy', 'TwofaController@google_admin_verfiy')->name('google_admin_verfiy');
});


Route::group(['middleware' => ['admin', 'twofa'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('adminwallet', 'AdminWalletController@index')->name('adminwallet');
	Route::get('feewallet', 'AdminWalletController@feewallet')->name('feewallet');
	Route::get('dashboard', 'DashboardController@index');
	Route::post('/userssearch', 'DashboardController@userSearchList');
	Route::get('mobile_security', 'DashboardController@mobile_security');
	Route::post('update_security', 'DashboardController@update_security');

	//Users
	Route::get('users', 'UserController@index');

	Route::get('users_edit/{id}', 'UserController@edit')->name("user.edit");
	Route::get('users_block/{id}', 'UserController@users_block');

	Route::post('update_user/{id}', 'UserController@update');
	Route::get('users_wallet/{id}', 'UserController@userWallet')->name("user.wallet");
	Route::get('users/search', 'UserController@usersearch');

	Route::get('users_address/{uid}/{coin}', 'UserController@users_address');
	Route::post('update_bank', 'UserController@update_bank');
	Route::post('update_withdraw_address', 'UserController@update_withdraw_address');
	Route::get('users_referral/{id}', 'UserController@UsersReferral');

	Route::get('userdeposit/{id}', 'UserController@userdeposit')->name("user.deposit");
	Route::get('userkyc/{id}', 'UserController@userkyc')->name("user.kyc");

	Route::get('userfiatdeposit/{id}', 'UserController@userfiatdeposit')->name("user.fiat_deposit");
	Route::get('user_fiatdeposit_edit/{id}', 'UserController@user_fiatdeposit_edit');
	Route::post('user_fiatdeposit_update', 'UserController@user_fiatdeposit_update');

	Route::get('user_withdraw/{id}', 'UserController@UserWithdrawList')->name("user.withdraw");
	Route::get('user_crypto_withdraw_edit/{id}', 'UserController@WithdrawCryptoEdit');
	Route::post('user_update_cryptowithdraw', 'UserController@updateCryptoWithdraw');

	Route::post('Balance_update', 'UserController@Balance_update');
	Route::post('Balance_reduce', 'UserController@Balance_reduce');

	Route::get('walletview/{id}', 'UserController@Walletview');
	Route::post('walletupdate', 'UserController@Walletupdate');
	Route::get('transactionall/{id}/{coin}', 'UserController@Transactionall');

	Route::get('user_fiat_withdraw/{id}', 'UserController@user_fiat_withdraw')->name("user.fiat_withdraw");
	Route::get('fiat_withdraw_edit/{id}', 'UserController@fiat_withdraw_edit');
	Route::post('fiat_withdraw_update', 'UserController@fiat_withdraw_update');
	Route::get('user_buy_tradehistory/{id}', 'UserController@user_buy_tradehistory')->name("user.buy_trade");
	Route::get('user_sell_tradehistory/{id}', 'UserController@user_sell_tradehistory')->name("user.sell_trade");

	//Trade
	Route::get('buy_tradehistory/{pair}/{type}', 'TradesController@buyTradeHistory');
	Route::get('sell_tradehistory/{pair}/{type}', 'TradesController@sellTradeHistory');

	Route::get('pending_tradehistory/{pair}', 'TradesController@pendingTradeHistory');
	Route::get('pending_tradehistory/{pair}/{otype}', 'TradesController@pendingTradeHistory');
	Route::get('/cancelOrder/{trade_type}/{id}', 'TradeCancelController@cancelOrder')->name('cancelbuyorder');

	//Deposit
	Route::get('deposits/{coin}', 'HistroyController@DepositList');
	Route::get('cryptodeposit/{id}', 'HistroyController@CryptoDepositEdit');
	Route::post('cryptodeposit_update', 'HistroyController@CryptoDepositUpdate');
	Route::get('fiatdeposit_edit/{id}', 'HistroyController@FiatDepositEdit');
	Route::post('fiatdeposit_update', 'HistroyController@FiatDepositUpdate');

	Route::get('instant/{type}', 'HistroyController@InstantList');

	//Withdraw
	Route::get('withdraw/{coin}', 'HistroyController@WithdrawList');
	Route::get('crypto_withdraw_edit/{id}', 'HistroyController@WithdrawCryptoEdit');

	Route::post('update_cryptowithdraw', 'HistroyController@updateCryptoWithdraw');
	Route::get('withdraw_edit/{id}', 'HistroyController@withdrawFiatEdit');
	Route::post('withdraw_update', 'HistroyController@withdrawFiatUpdate');

	//Kyc
	Route::get('kyc', 'KycController@index');
	Route::get('kycview/{id}', 'KycController@kycview');
	Route::post('kycupdate', 'KycController@kycUpdate');

	Route::get('kyclimit', 'KycController@kyclimit');
	Route::post('fiatlimitupdate', 'KycController@fiatlimitupdate');
	Route::post('coinlimitupdate', 'KycController@coinlimitupdate');

	Route::get('incomecer', 'KycController@Incomekyc');
	Route::get('incomekycview/{id}', 'KycController@Incomekycview');
	Route::post('incomekycupdate', 'KycController@IncomekycUpdate');

	Route::get('professcer', 'KycController@Professkyc');
	Route::get('professkycview/{id}', 'KycController@Professkycview');
	Route::post('professkycupdate', 'KycController@ProfessUpdate');

	//Liveprice
	Route::get('liveprice', 'LivepriceController@index');
	Route::get('addliveprice', 'LivepriceController@Addliveprice');
	Route::get('livepriceedit/{id}', 'LivepriceController@edit');
	Route::post('livepriceadd', 'LivepriceController@Livepriceadd');
	Route::post('livepriceupdate', 'LivepriceController@Livepriceupdate');

	//Commission
	Route::get('commission', 'CommissionController@index');
	Route::get('commissionsettings/{id}', 'CommissionController@edit');
	Route::post('commissionupdate', 'CommissionController@commissionUpdate');
	Route::get('listingsettings/{id}', 'SupportController@editlisting');

	//Trade pair
	Route::get('coinlist', 'TradepairController@index');
	Route::get('deletedcoin/{id}', 'TradepairController@coinDelete');
	Route::get('coinsettings/{id}', 'TradepairController@edit');
	Route::post('coinupdate', 'TradepairController@Update');
	Route::get('addcoin', 'TradepairController@addcoin');
	Route::post('addcoininsert', 'TradepairController@addcoininsert');
	Route::get('tradepairlist', 'TradepairController@tradepairlist');
	Route::get('pairedit/{id}', 'TradepairController@pairedit');
	Route::get('addpair', 'TradepairController@addpair');
	Route::post('addpairinsert', 'TradepairController@addpairinsert');
	Route::post('pairupdate/{id}', 'TradepairController@pairupdate');

	//Support
	Route::get('support', 'SupportController@index');
	Route::get('reply/{id}', 'SupportController@reply');
	Route::post('tickets/adminsavechat', 'SupportController@adminsavechat');
	Route::post('tickets/adminajaxchat', 'SupportController@userajaxchat');
	Route::get('completeChat/{id}', 'SupportController@completeChat');
	Route::get('listing', 'SupportController@listing');

	Route::get('subscriber', 'SupportController@subscriber');
	Route::get('subscriberdelete/{id}', 'SupportController@subscriberdelete');
	Route::get('contactus', 'SupportController@contactus');
	Route::get('contactremove/{id}', 'SupportController@contactremove');

	//Bank
	Route::get('bank/{fiat}', 'BankController@index');
	Route::get('addbank/{fiat}', 'BankController@addbank');
	Route::post('bankadd', 'BankController@bankadd');
	Route::post('paymentadd', 'BankController@paymentadd');
	Route::get('edit_bank/{id}/{fiat}', 'BankController@editBank');
	Route::post('updateBank', 'BankController@updateBank');

	Route::get('view_payment/{id}/{fiat}', 'BankController@ViewPayment');
	Route::post('updatePayment', 'BankController@updatePayment');

	//mpesa
	Route::get('mpesa', 'BankController@mpesa');
	Route::get('mpesa/edit', 'BankController@mpesaedit');
	Route::post('mpesa/update/{id}', 'BankController@mpesaupdate');
	Route::get('mpesadelete', 'BankController@delete');

	Route::get('feewalletaddress', 'BankController@feewalletaddress');

	//coldwallet addresses
	Route::get('coldwalletaddress', 'BankController@coldwalletaddress');
	Route::get('addcoldwalletaddress', 'BankController@addcoldwalletaddress');
	Route::post('coldwalletaddressadd', 'BankController@coldwalletaddressadd');
	Route::get('coldwalletaddress/edit', 'BankController@coldwalletaddressedit');
	Route::post('coldwalletaddress/update', 'BankController@coldwalletaddressupdate');
	// Route::get('coldwalletaddressdelete/{id}', 'BankController@coldwalletaddressdelete');

	//Site Settings
	Route::get('logo', 'SettingsController@logo');
	Route::post('update_logo', 'SettingsController@updateLogo');

	Route::get('tc', 'SettingsController@tc');
	Route::post('update_terms', 'SettingsController@update_terms');

	Route::get('crypto', 'SettingsController@crypto');
	Route::post('update_crypto', 'SettingsController@update_crypto');

	Route::get('credit', 'SettingsController@credit');
	Route::post('update_credit', 'SettingsController@update_credit');

	Route::get('privacy', 'SettingsController@privacy');
	Route::post('update_privacy', 'SettingsController@updatePrivacy');

	Route::get('securitypage', 'SettingsController@securitypage');
	Route::post('update_securitypage', 'SettingsController@updatesecuritypage');

	Route::get('webdisclaimer', 'SettingsController@webdisclaimer');
	Route::post('update_webdisclaimer', 'SettingsController@updatewebdisclaimer');

	Route::get('mobileappdescription', 'SettingsController@mobileappdescription');
	Route::post('update_mobileappdescription', 'SettingsController@updatemobileappdescription');
	Route::get('listingstatus', 'SettingsController@listingstatus');
	Route::post('update_listingstatus', 'SettingsController@updatelistingstatus');

	Route::get('warning', 'SettingsController@warning');
	Route::post('update_warning', 'SettingsController@updatewarning');

	Route::get('aboutus', 'SettingsController@aboutus');
	Route::post('update_about', 'SettingsController@updateAbout');

	Route::get('mpisa', 'SettingsController@mpisaDescription');
	Route::post('update_mpisa', 'SettingsController@mpisaDescription_update');

	Route::get('features', 'SettingsController@features');
	Route::post('features_update', 'SettingsController@features_settings');
	Route::get('statistics', 'SettingsController@CMS');
	Route::post('statistics_update', 'SettingsController@CMS_settings');

	Route::get('howitworks', 'SettingsController@howitworks');
	Route::post('howitworks_update', 'SettingsController@howitworks_update');

	Route::get('aml', 'SettingsController@AML');
	Route::post('update_aml', 'SettingsController@update_aml');


	Route::get('faq', 'SettingsController@faq');
	Route::get('/faq_add', 'SettingsController@faq_add');
	Route::post('/faq_save', 'SettingsController@faq_save');
	Route::get('/faq_edit/{id}', 'SettingsController@faq_edit');
	Route::post('/faq_update', 'SettingsController@faq_update');
	Route::get('/faq_remove/{id}', 'SettingsController@faq_remove');

	Route::get('socialmedia', 'SettingsController@socialmedia');
	Route::post('save_social_media', 'SettingsController@saveSocialMedia');

	Route::get('termsservices', 'SettingsController@termServices');
	Route::post('save_termsservices', 'SettingsController@saveTermServices');


	Route::get('homepage', 'SettingsController@homePage');
	Route::post('save_homepage', 'SettingsController@saveHomepage');


	Route::get('referral', 'SettingsController@referral');
	Route::post('save_referral', 'SettingsController@savereferral');

	Route::get('liveprice', 'SettingsController@livepriceview');
	Route::post('view_liveprice', 'SettingsController@viewLiveprice');


	Route::get('securityview', 'SettingsController@securityview');
	Route::post('securityupdate', 'SettingsController@update_kyc');

	//Security
	Route::get('security', 'DashboardController@security');
	Route::post('changeusername', 'DashboardController@updateUsername');
	Route::post('changepassword', 'DashboardController@changepassword');
	Route::get('adminDisabletwofa', 'DashboardController@adminDisabletwofa');
	Route::get('adminEnabletwofa', 'DashboardController@adminEnabletwofa');
	Route::post('verifyTwoFaCode', 'DashboardController@verifyTwoFaCode');

	//menu email
	Route::get('menu', 'DashboardController@menu');

	Route::get('tokenlist', 'TradepairController@index');
	Route::get('coinsettings/{id}', 'TradepairController@edit');
	Route::post('coinupdate', 'TradepairController@Update');
	Route::get('addtoken', 'TradepairController@addtoken');
	Route::post('addtokeninsert', 'TradepairController@addtokeninsert');

	//liquidity details
	Route::get('liquidity', 'LiquidityController@liq');
	Route::get('liquidityadd', 'LiquidityController@add');
	Route::post('addliq', 'LiquidityController@addliq');
	Route::get('liquidityedit/{id}', 'LiquidityController@edit');

	Route::post('updateliq', 'LiquidityController@updateliq');



	//time setting
    Route::get('time-settings','TimeSettingController@index')->name('admin.times.index');
    Route::post('time-store/{id?}','TimeSettingController@saveTime')->name('admin.times.store');
    Route::post('time-delete','TimeSettingController@delete')->name('admin.times.delete');

	  //plan
    Route::get('plans','PlanController@index')->name('admin.plans.index');
    Route::post('plans/store','PlanController@savePlan')->name('admin.plans.store');
    Route::post('plans/update/{id}','PlanController@savePlan')->name('admin.plans.update');




});