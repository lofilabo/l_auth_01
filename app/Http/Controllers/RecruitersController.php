<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recruiters;

use App\Statuscodes;

class RecruitersController extends Controller
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
                $arrCities = Recruiters::orderBy('id', 'ASC')->get()->toArray();
                break;
            case "iddown":
                $arrCities = Recruiters::orderBy('id', 'DESC')->get()->toArray();
                break;
            case "fnameup":
                $arrCities = Recruiters::orderBy('fname', 'ASC')->get()->toArray();
                break;
            case "fnamedown":
                $arrCities = Recruiters::orderBy('fname', 'DESC')->get()->toArray();
                break;
            case "lnameup":
                $arrCities = Recruiters::orderBy('lname', 'ASC')->get()->toArray();
                break;
            case "lnamedown":
                $arrCities = Recruiters::orderBy('lname', 'DESC')->get()->toArray();
                break;
            case "emailup":
                $arrCities = Recruiters::orderBy('email', 'ASC')->get()->toArray();
                break;
            case "emaildown":
                $arrCities = Recruiters::orderBy('email', 'DESC')->get()->toArray();
                break;
            case "telup":
                $arrCities = Recruiters::orderBy('tel', 'ASC')->get()->toArray();
                break;
            case "teldown":
                $arrCities = Recruiters::orderBy('tel', 'DESC')->get()->toArray();
                break;
            case "urlup":
                $arrCities = Recruiters::orderBy('url', 'ASC')->get()->toArray();
                break;
            case "urldown":
                $arrCities = Recruiters::orderBy('url', 'DESC')->get()->toArray();
                break;
            case "createtup":
                $arrCities = Recruiters::orderBy('created_at', 'ASC')->get()->toArray();
                break;
            case "createddown":
                $arrCities = Recruiters::orderBy('created_at', 'DESC')->get()->toArray();
                break;
            default:
                $arrCities = Recruiters::get()->toArray();
        }

        return view('Recruiters.read_recruiters', ["arr" => $arrCities, "stat"=>$this->statuscodes, "action"=>$action]);
    }
    public function read_one($id){
        $arrCities = Recruiters::where('id', $id)->get()->toJson();
        return $arrCities;
    }
    public function new_one(){
        return view('Employers.read_employers', ["whoami" => "I am Euronymous"]);
    }
    public function create_one(Request $request){
        return view('Employers.read_employers', ["whoami" => "I am Abbath"]);
    }
    public function update_one(Request $request){
        $id = $request['modal-input-id'];
        $arrCities = Recruiters::find($id);
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
                return redirect()->route('recruiters', ['action' => $request->input('action')] );

    }
    public function delete_one(Request $request){
        return view('Employers.read_employers', ["whoami" => "I am Ildjaarn"]);
    }

}
