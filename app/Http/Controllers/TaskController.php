<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityMaster;
use App\State;
use App\User;
use DB;

class TaskController extends Controller
{
    public function getAllData() {
    	$start_time = microtime(true);
    	$users = DB::select('SELECT id, name FROM users');
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

    public function test() {
    	$response = TaskController::getData();
    	dd($response["time"]);
    }
}
