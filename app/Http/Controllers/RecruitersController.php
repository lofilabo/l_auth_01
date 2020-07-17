<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recruiters;

class RecruitersController extends Controller
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
        $arrCities = Recruiters::get()->toArray();
        return view('Recruiters.read_recruiters', ["arr" => $arrCities]);
    }
    public function read_one($id){
        $arrCities = Recruiters::where('id', $id)->get()->toJson();
        return $arrCities;
    }
    public function new_one(){
        return view('Employers.read_employers', ["whoami" => "I am Euronymous"]);
    }
    public function create_one(){
        return view('Employers.read_employers', ["whoami" => "I am Abbath"]);
    }
    public function update_one(){
        return view('Employers.read_employers', ["whoami" => "I am Zwerg"]);
    }
    public function delete_one(){
        return view('Employers.read_employers', ["whoami" => "I am Ildjaarn"]);
    }

}
