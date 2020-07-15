<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resp_meta;

class Resp_metaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read(){
    	$arrCities = Resp_meta::get()->toArray();
        return view('Resp_meta.read', ["arr" => $arrCities]);
    }
}
