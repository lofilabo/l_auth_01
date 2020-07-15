<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_ses_jobseeker;

class Resp_ses_jobseekerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_ses_jobseeker::get()->toArray();
        return view('Resp_ses_jobseeker.read', ["arr" => $arrCities]);
    }
}
