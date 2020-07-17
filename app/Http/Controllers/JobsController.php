<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs;

class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read_many(){
        $arrCities = Jobs::get()->toArray();
        return view('Jobs.read_jobs', ["arr" => $arrCities]);
    }
    public function read_one($id){
        $arrCities = Jobs::where('id', $id)->get()->toJson();
        return $arrCities;}
    public function new_one(){
        return view('Jobs.read_jobs', ["whoami" => "I am Euronymous"]);
    }
    public function create_one(){
        return view('Jobs.read_jobs', ["whoami" => "I am Abbath"]);
    }
    public function update_one(){
        return view('Jobs.read_jobs', ["whoami" => "I am Zwerg"]);
    }
    public function delete_one(){
        return view('Jobs.read_jobs', ["whoami" => "I am Ildjaarn"]);
    }

}
