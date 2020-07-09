<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_jobseeker;

class Resp_jobseekerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_jobseeker::get()->toArray();
        return view('Resp_jobseeker.read', ["arr" => $arrCities]);
    }
}
