<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Resp_contact;

class Resp_contactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_contact::get()->toArray();
        return view('Resp_contact.read', ["arr" => $arrCities]);
    }
}
