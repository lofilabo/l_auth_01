<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_catchall;

class Resp_catchallController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_catchall::get()->toArray();
        return view('Resp_catchall.read', ["arr" => $arrCities]);
    }
}
