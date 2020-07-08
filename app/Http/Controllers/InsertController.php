<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityMaster;
use App\State;
use App\User;
use DB;

class InsertController extends Controller
{
    public function insertCityData() {
    	$temp_data = DB::select('SELECT city_name from cities');
    	foreach ($temp_data as $city) {
    		$city_obj = new CityMaster();
    		$city_obj->city_name = $city->city_name;
    		$city_obj->save();
    	}
    	return "Data insert successfully";
    }

    public function insertStateData() {
    	$temp_data = DB::select('SELECT distinct city_state FROM cities;');
    	foreach ($temp_data as $state) {
    		$state_obj = new State();
    		$state_obj->state_name = $state->city_state;
    		$state_obj->save();
    	}
    	return "Data insert successfully";
    }

    public function insertUserData() {
    	$temp_users = DB::select('SELECT * from usernames;');
    	$states = DB::select('SELECT * from states;');
    	$cities = DB::select('SELECT * from city_masters;');
    	
    	$state_counter = 0;
    	$city_counter = 0;
        for ($i = 0; $i < 8; $i++) {
        	for ($j = 0; $j < count($temp_users); $j++) {
                DB::table('users')->insert(['name' => $temp_users[$j]->name, 'city_id' => $cities[$city_counter]->id, 'state_id' => $states[$state_counter]->id]);
        		$state_counter++;
        		$city_counter++;
        		if ($state_counter == count($states))
        			$state_counter = 0;
        		if ($city_counter == count($cities))
        			$city_counter = 0;
        	}
        }
    	return "User created";
    }
}
