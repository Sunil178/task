<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityMaster;
use App\State;
use App\User;
use App\Recharge;
use DB;

class TaskController extends Controller
{
    public function getAllData() {
    	$start_time = microtime(true);
    	// $users = DB::select('SELECT id, name FROM users');
    	$users = DB::select('CALL select_users;');
    	$end_time = microtime(true);
    	$time = $end_time - $start_time;
    	$time = number_format($time, 3);
    	$response["data"] = json_encode($users);
    	$response["time"] = $time;
    	return $response;
    }

    public function getSpecificData($city, $state) {
    	$start_time = microtime(true);
    	$users = DB::select('SELECT users.id, users.name from users JOIN city_masters ON city_masters.id = users.city_id JOIN states ON states.id = users.state_id where city_masters.city_name = ? AND states.state_name = ?', [$city, $state]);
    	$end_time = microtime(true);
    	$time = $end_time - $start_time;
    	$time = number_format($time, 3);
    	$response["data"] = json_encode($users);
    	$response["time"] = $time;
    	return $response;
    }

    public function getAllCity() {
    	$start_time = microtime(true);
    	$cities = DB::select('SELECT id, city_name FROM city_masters');
    	$end_time = microtime(true);
    	$time = $end_time - $start_time;
    	$time = number_format($time, 3);
    	$response["data"] = json_encode($cities);
    	$response["time"] = $time;
    	return $response;
    }

    public function getAllState() {
    	$start_time = microtime(true);
    	$cities = DB::select('SELECT id, state_name FROM states');
    	$end_time = microtime(true);
    	$time = $end_time - $start_time;
    	$time = number_format($time, 3);
    	$response["data"] = json_encode($cities);
    	$response["time"] = $time;
    	return $response;    	
    }

    public function testState() {
    	$states = DB::select('SELECT id, state_name FROM states');
    	$states = json_encode($states);
    	return $states;
    }

    public function testCity() {
    	$cities = DB::select('SELECT id, city_name FROM city_masters');
    	$cities = json_encode($cities);
    	return $cities;
    }


    public function rechargeResponse($accountId, $txid, $optxid, $transtype) {

        $recharge = new Recharge();
        $recharge->accountId = $accountId;
        $recharge->txid = $txid;
        $recharge->optxid = $optxid;
        $recharge->transtype = $transtype;
        $recharge->save();
        $response['accountId'] = $accountId;
        $response['txid'] = $txid;
        $response['optxid'] = $optxid;
        $response['transtype'] = $transtype;
        return $response;
    }

    public function rechargeRequest () {
        $client_key = 'CK' . time();
        $ch = curl_init();
        $url = 'http://rechargepay.biz/api.php?username=9819626638&password=9838&number=8369465281&operator=6&amount=11&txid=' . $client_key;
        // $url = 'http://rechargepay.biz/api.php?username=9819626638&password=9838&number=8450912186&operator=1&amount=11&txid=' . $client_key;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
