<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_alliance;

class Resp_allianceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_alliance::get()->toArray();
        return view('Resp_alliance.read', ["arr" => $arrCities]);
    }
}
