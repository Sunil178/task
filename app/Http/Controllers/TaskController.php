<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityMaster;
use App\State;
use App\User;
use DB;

class TaskController extends Controller
{
    public function getData() {
    	$users = DB::select('SELECT * FROM users');
    	$users = json_encode($users);
    	return $users;
    }
}
