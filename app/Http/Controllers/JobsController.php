<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs;

use App\Statuscodes;

class JobsController extends Controller
{

    protected $statuscodes = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Statuscodes::get()->each(function($pair){
            //var_dump($pair->statusid);
            $this->statuscodes[$pair->statusid] = $pair->statusdescription;
        });

        //$this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read_many(Request $request){
        $action = $request->input('action');
        //dd($action);
        switch ($action){
            case "idup":
                $arrCities = Jobs::orderBy('id', 'ASC')->get()->toArray();
                break;
            case "iddown":
                $arrCities = Jobs::orderBy('id', 'DESC')->get()->toArray();
                break;
            case "fnameup":
                $arrCities = Jobs::orderBy('fname', 'ASC')->get()->toArray();
                break;
            case "fnamedown":
                $arrCities = Jobs::orderBy('fname', 'DESC')->get()->toArray();
                break;
            case "lnameup":
                $arrCities = Jobs::orderBy('lname', 'ASC')->get()->toArray();
                break;
            case "lnamedown":
                $arrCities = Jobs::orderBy('lname', 'DESC')->get()->toArray();
                break;
            case "emailup":
                $arrCities = Jobs::orderBy('email', 'ASC')->get()->toArray();
                break;
            case "emaildown":
                $arrCities = Jobs::orderBy('email', 'DESC')->get()->toArray();
                break;
            case "telup":
                $arrCities = Jobs::orderBy('tel', 'ASC')->get()->toArray();
                break;
            case "teldown":
                $arrCities = Jobs::orderBy('tel', 'DESC')->get()->toArray();
                break;
            case "urlup":
                $arrCities = Jobs::orderBy('url', 'ASC')->get()->toArray();
                break;
            case "urldown":
                $arrCities = Jobs::orderBy('url', 'DESC')->get()->toArray();
                break;
            case "createtup":
                $arrCities = Jobs::orderBy('created_at', 'ASC')->get()->toArray();
                break;
            case "createddown":
                $arrCities = Jobs::orderBy('created_at', 'DESC')->get()->toArray();
                break;
            default:
                $arrCities = Jobs::get()->toArray();
        }

        return view('Jobs.read_jobs', ["arr" => $arrCities, "stat"=>$this->statuscodes, "action"=>$action]);
    }
    public function read_one($id){
        $arrCities = Jobs::where('id', $id)->get()->toJson();
        return $arrCities;}
    public function new_one(){
         return view('Jobs.new_jobs',["stat"=>$this->statuscodes]);
    }
    public function create_one(Request $request){
        $arrCities = new Jobs;
        $arrCities->fname           =   ($request['modal-input-fname']);
        $arrCities->lname           =   ($request['modal-input-lname']);
        $arrCities->tel             =   ($request['modal-input-tel']);
        $arrCities->email           =   ($request['modal-input-email']);
        $arrCities->url             =   ($request['modal-input-url']);
        $arrCities->personincharge  =   ($request['modal-input-personincharge']);
        $arrCities->ketai           =   ($request['modal-input-ketai']);
        $arrCities->contactother    =   ($request['modal-input-contactother']);
        $arrCities->cv              =   ($request['modal-input-note1']);
        $arrCities->note1           =   ($request['modal-input-note2']);
        $arrCities->note2           =   ($request['modal-input-note2']);
        $arrCities->note3           =   ($request['modal-input-note2']);
        $arrCities->note4           =   ($request['modal-input-note2']);
        $arrCities->status          =   1;
        $rez = $arrCities->save();
        return redirect()->route('jobs', ['action' => $request->input('action')] );
    }
    public function update_one(Request $request){
        $id = $request['modal-input-id'];
        $arrCities = Jobs::find($id);
        $arrCities->fname = ($request['modal-input-fname']);
        
        $arrCities->fname           =   ($request['modal-input-fname']);
        $arrCities->lname           =   ($request['modal-input-lname']);
        $arrCities->tel             =   ($request['modal-input-tel']);
        $arrCities->email           =   ($request['modal-input-email']);
        $arrCities->url             =   ($request['modal-input-url']);
        $arrCities->personincharge  =   ($request['modal-input-personincharge']);
        $arrCities->ketai           =   ($request['modal-input-ketai']);
        $arrCities->contactother    =   ($request['modal-input-contactother']);
        $arrCities->cv              =   ($request['modal-input-note1']);
        $arrCities->note1           =   ($request['modal-input-note2']);
        $arrCities->note2           =   ($request['modal-input-note2']);
        $arrCities->note3           =   ($request['modal-input-note2']);
        $arrCities->note4           =   ($request['modal-input-note2']);
        $arrCities->status          =   ($request['modal-input-status']);
        $rez = $arrCities->save();
        return redirect()->route('jobs', ['action' => $request->input('action')] );
    }
    public function delete_one(Request $request){
        return view('Jobs.read_jobs', ["whoami" => "I am Ildjaarn"]);
    }

}
