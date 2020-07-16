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
        return view('Candidates.read_candidates', ["whoami" => "I am Nagash"]);
    }
    public function read_one($id){
        return view('Candidates.read_candidates', ["whoami" => "I am Graahl " . $id]);
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
