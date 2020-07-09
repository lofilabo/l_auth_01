<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_ses_recruitment;

class Resp_ses_recruitmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_ses_recruitment::get()->toArray();
        return view('Resp_ses_recruitment.read', ["arr" => $arrCities]);
    }
}
