<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_recruitment;

class Resp_recruitmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_recruitment::get()->toArray();
        return view('Resp_recruitment.read', ["arr" => $arrCities]);
    }
}
