<?php


function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false){
    $separator = '';
    if($separate){
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if($exceptZeros){
    $exp = explode('.', $printAmount);
        if($exp[1]*1 == 0){
            $printAmount = $exp[0];
        }
    }
    return $printAmount;
}

function display_format($number, $digit=8, $format=null)
{
    if ($format =="") {
        $twocoin = sprintf('%.'.$digit.'f', $number);
    } elseif ($format==0) {
        $twocoin = number_format($number, $digit);
    } else {
        $twocoin = number_format($number, $digit, ",", ".");
    }
    return $twocoin;
}

function isJson($string,$array = false) {
    $res = json_decode($string,$array);
    $status = json_last_error() === JSON_ERROR_NONE && !empty($string);
    return (object)[
        "status" => $status,
        "data" => $res
    ];
 }

function user($id)
{
    $user = App\User::on('mysql2')->where('id', $id)->first();

    return $user;
}
function username($id)
{
    $user = App\Models\User::on('mysql2')->where('id', $id)->first();
    if ($user) {
        return $user->name;
    } else {
        return false;
    }
}
function currency($type)
{
    if ($type == 4) {
        $currency = 'USD';
    } elseif ($type == 5) {
        $currency = 'TRY';
    } else {
        $currency = 'EUR';
    }
    return $currency;
}
function country()
{
    $countries = App\Models\Countries::on('mysql2')->get();

    return $countries;
}

function first_pair()
{
    $Tradepair = \App\Models\Tradepair::on('mysql2')->first();
    $pair =$Tradepair->coinone.'_'.$Tradepair->cointwo;

    return $pair;
}

function bank($id)
{
    $bank = App\Models\Bank::on('mysql2')->where('id', $id)->first();
    
    return $bank;
}
function list_coin()
{
    $coins = App\Models\Commission::on('mysql2')->get();
    return $coins;
}
function ncAdd($value1, $value2, $digit = 8)
{
	$value = bcadd(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}
function ncSub($value1, $value2, $digit = 8)
{
	$value = bcsub(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}
function ncMul($value1, $value2, $digit = 8)
{
	$value = bcmul(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}

function ncDiv($value1, $value2, $digit = 8)
{
	$value = bcdiv(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}
function ticketcount()
{
    $ticketcount = App\Models\Supportchat::on('mysql2')->where('admin_status', 0)->count();
    return $ticketcount;
}
 function TransactionString($length = 60)
 {
     $str = substr(hash('sha256', mt_rand() . microtime()), 0, $length);
     return $str;
 }
function seoUrl($string)
{
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

    
function types($types)
{
    if ($types != '') {
        $array = array('deposit'=>'1','deposit_internal'=>'2','deposit_commission'=>'3','deposit_fee'=>'4','withdraw'=>'5','withdraw_internal'=>'6','withdraw_commission'=>'7','withdraw_fee'=>'8','tradebuy'=>'9','tradesell'=>'10','trade_commission'=>'11','affiliate_commission'=>'12');
        return $array[$types];
    }
}

 function typesname($types)
 {
     if ($types > 0) {
         $array = array('1'=>'Deposit External','2'=>'Deposit Internal','3'=>'Deposit Commission','4'=>'Deposit Fee','5'=>'Withdraw External','6'=>'Withdraw Internal','7'=>'Withdraw Commission','8'=>'Withdraw Fee','9'=>'Trade Buy','10'=>'Trade Sell','11'=>'Trade Commission','12'=>'Affiliate Commission');
         return $array[$types];
     }
 }

 function filter($value)
 {
     return filter_var($value, FILTER_SANITIZE_STRING);
 }

 

function list_currencies()
{
    $currency = App\Models\P2p\Countries::on('mysql2')->distinct()->where('currency_code', '!=', '')->get('currency_code');
    return $currency;
}

function convertTimeZone($date, $converted = false, $chart = false)
{
    //get user login
    $user_id = '';
    if (Auth::user()) {
        $user_id = Auth::user()->id;
    }
    $curent_timezone = 'UTC';
    if ($user_id != '') {
        $is_login = App\User::where('id', $user_id)->first();
        if (is_object($is_login)) {
            $curent_timezone = $is_login->timezone;
            if ($curent_timezone == null || $curent_timezone == '') {
                $curent_timezone = 'UTC';
            }
        }
    }

    if (!$converted) {
        $date = new DateTime($date, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($curent_timezone));
        $time = $date->format('d-m-Y H:i:s');
    } elseif ($chart) {
        $date = new DateTime($date, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone('UTC'));
        $date->modify('+1 day');
        $time = $date->format('Y-m-d');
        $time = strtotime($time)."000";
    } elseif ($converted == 'integer') {
        $date = new DateTime($date, new DateTimeZone($curent_timezone));
        $date->setTimezone(new DateTimeZone($curent_timezone));
        $time = $date->format('d-m-Y H:i:s');
    } elseif ($converted == 'time_only') {
        $date = new DateTime($date, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($curent_timezone));
        $time = $date->format('H:i:s');
    } elseif ($converted == 'clock_time') {
        $date = new DateTime($date, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($curent_timezone));
        $time = $date->format('Y/m/d H:i:s');
    } else {
        $date = new DateTime($date, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($curent_timezone));
        $time = $date->format('d-m-Y');
    }
    return $time;
}

function is_keywords(array $post_values)
{
    //$restrict_keywords = array('create','insert','modify','delete','update','drop','truncate','select','replace','show','orderby');
    
    $restrict_keywords =[];

    $flag = false;
    foreach ($post_values as $key => $value) {
        foreach ($restrict_keywords as $keyword) {
            $mystring = strtolower($keyword);
            $value = (is_array($value))?implode(',', $value):$value;
            if (strpos(strtolower($value), $mystring) !== false) {
                $flag = true;
                return $flag;
            }
            if (strpos(strtolower($key), $mystring) !== false) {
                $flag = true;
                return $flag;
            }
        }
    }
    return $flag;
}

function binance(){
    $liquidity = \App\Models\Liquidity::first();
    return new \Binance\API($liquidity->apikey,$liquidity->secretkey, $liquidity->testnet == 1 ? true : false);
}

function getTokenInfo($network, $contract_address){
    try {
        if($network == "ERC20"){
            $curl = curl_init();
            $apiKey = config("services.ETHERSCAN_API_KEY");
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.etherscan.io/api?module=account&action=tokentx&&contractaddress=$contract_address&startblock=0&endblock=99999999&sort=asc&apikey=$apiKey&offset=1&page=1",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($httpcode == 200){
                $response = json_decode($response,true);
                $transaction = $response["result"][0];
                return [
                    "symbol" => $transaction["tokenSymbol"],
                    "name" => $transaction["tokenName"],
                    "decimal" => (int) $transaction["tokenDecimal"]
                ];
            } else {
                return [];
            }
        } elseif($network == "BEP20"){
            $curl = curl_init();
            $apiKey = config("services.BSCSCAN_API_KEY");
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.bscscan.com/api?module=account&action=tokentx&&contractaddress=$contract_address&startblock=0&endblock=99999999&sort=asc&apikey=$apiKey&offset=1&page=1",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($httpcode == 200){
                $response = json_decode($response,true);
                $transaction = $response["result"][0];
                return [
                    "symbol" => $transaction["tokenSymbol"],
                    "name" => $transaction["tokenName"],
                    "decimal" => (int) $transaction["tokenDecimal"]
                ];
            } else {
                return [];
            }
        }
        return [];
    } catch (\Throwable $th) {
        return [];
    }
}
