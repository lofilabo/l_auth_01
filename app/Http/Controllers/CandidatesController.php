<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Candidates;

class CandidatesController extends Controller
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
        $arrCities = Candidates::get()->toArray();
        return view('Candidates.read_candidates', ["arr" => $arrCities]);
    }
    public function read_one($id){
        $arrCities = Candidates::where('id', $id)->get()->toJson();
        return $arrCities;
    }
    public function new_one(){
        return view('Candidates.read_candidates', ["whoami" => "I am Euronymous"]);
    }
    public function create_one(){
        return view('Candidates.read_candidates', ["whoami" => "I am Abbath"]);
    }
    public function update_one(){
        return view('Candidates.read_candidates', ["whoami" => "I am Zwerg"]);
    }
    public function delete_one(){
        return view('Candidates.read_candidates', ["whoami" => "I am Ildjaarn"]);
    }

}
