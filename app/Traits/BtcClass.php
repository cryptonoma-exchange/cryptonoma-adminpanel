<?php

namespace App\Traits;

use App\Models\CoinAddress;
use App\Models\Commission;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserWallet;
use App\Models\UserBtcAddress;
use App\Traits\Bitcoin;
use Illuminate\Support\Facades\DB;

trait BtcClass
{
    use Bitcoin;

    public function create_user_btc($uid)
    {
        $symbol = "BTC";
        $network = "MAINNET";
        $address = UserBtcAddress::where('user_id', $uid)->value('address');
        DB::connection('mysql')->beginTransaction();
        DB::connection('mysql2')->beginTransaction();
        try {
            if (empty($address)) {
                $btc = $this->createaddress_btc();
                $address = $btc->address;
                $publickey = Crypt::encrypt($btc->publickey);
                $wif = Crypt::encrypt($btc->wif);
                $privatekey = Crypt::encrypt($btc->privatekey);
                $btcaddress = new UserBtcAddress;
                $btcaddress->user_id = $uid;
                $btcaddress->address = $address;
                $btcaddress->narcanru = $publickey . ',' . $wif . ',' . $privatekey;
                $btcaddress->balance = 0.00000000;
                $btcaddress->save();
            }
            if (!empty($address)) {
                $coin = Commission::where("source",$symbol)->first();
                $walletaddress = CoinAddress::where(['user_id' => $uid, 'coin_id' => $coin->id, "network" => $network])->lockForUpdate()->first();
                if (!$walletaddress) {
                    $walletaddress = new CoinAddress;
                    $walletaddress->user_id = $uid;
                    $walletaddress->coin_id = $coin->id;
                    $walletaddress->address = $address;
                    $walletaddress->network = $network;
                    $walletaddress->save();
                }
            }
          DB::connection('mysql')->commit();
          DB::connection('mysql2')->commit();
        } catch (\Throwable $th) {
          DB::connection('mysql')->rollback();
          DB::connection('mysql2')->rollback();
        }
        return $address;
    }

    public function bitcoin_npmcurl($body)
    {
        try {
            $id = 0;
            $status = null;
            $error = null;
            $raw_response = null;
            $response = null;

            $proto = "http";
            $username = env('RPC_USERNAME', '');
            $password = env('RPC_PASSWORD', '');
            $host = env('RPC_IP', ''); //"85.214.204.63";
            $port = env('RPC_PORT', ''); //"8222";
            $url = '';
            $CACertificate = null;
            $method = $body['method'];
            // If no parameters are passed, this will be an empty array
            $params = $body['params'];
            $params = array_values($params);
            // The ID should be unique for each call
            $id++;
            // Build the request, it's ok that params might have any empty array
            $request = json_encode(array(
                'jsonrpc' => "1.0",
                'method' => $method,
                'params' => $params,
                'id' => "curltest",
            ));
            //$curl    = curl_init("{$proto}://{$host}:{$port}/{$url}");
            $curl = curl_init("{$proto}://{$host}:{$port}/");
            $options = array(
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_USERPWD => $username . ':' . $password,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_HTTPHEADER => array('Content-type: application/json'),
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $request,
            );
            // This prevents users from getting the following warning when open_basedir is set:
            // Warning: curl_setopt() [function.curl-setopt]:
            //   CURLOPT_FOLLOWLOCATION cannot be activated when in safe_mode or an open_basedir is set
            if (ini_get('open_basedir')) {
                unset($options[CURLOPT_FOLLOWLOCATION]);
            }

            if ($proto == 'https') {
                // If the CA Certificate was specified we change CURL to look for it
                if (!empty($CACertificate)) {
                    $options[CURLOPT_CAINFO] = $CACertificate;
                    $options[CURLOPT_CAPATH] = DIRNAME($CACertificate);
                } else {
                    // If not we need to assume the SSL cannot be verified
                    // so we set this flag to FALSE to allow the connection
                    $options[CURLOPT_SSL_VERIFYPEER] = false;
                }
            }
            curl_setopt_array($curl, $options);
            // Execute the request and decode to an array
            $raw_response = curl_exec($curl);
            $response = json_decode($raw_response, true);
            // If the status is not 200, something is wrong
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // If there was no error, this will be an empty string
            $curl_error = curl_error($curl);
            curl_close($curl);
            if (!empty($curl_error)) {
                $error = $curl_error;
            }
            if ($response['error']) {
                // If EINR returned an error, put that in $error
                $error = $response['error']['message'];
            } elseif ($status != 200) {
                // If EINR didn't return a nice error message, we need to make our own
                switch ($status) {
                    case 400:
                        $error = 'HTTP_BAD_REQUEST';
                        break;
                    case 401:
                        $error = 'HTTP_UNAUTHORIZED';
                        break;
                    case 403:
                        $error = 'HTTP_FORBIDDEN';
                        break;
                    case 404:
                        $error = 'HTTP_NOT_FOUND';
                        break;
                }
            }
            if ($error) {
                print_r($error);
                return $error;
            }
            return $response;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return  $e;
        }
    }
}
