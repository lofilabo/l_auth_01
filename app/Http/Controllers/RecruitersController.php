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
        Statuscodes::where('statusid', "!=", "99")->get()->each(function($pair){
            $this->statuscodes[$pair->statusid] = $pair->statusdescription;
        });

        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read_many(Request $request){


        $action = $request->input('action');
        //dd($action);
        switch ($action){
            case "idup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('id', 'ASC')->get();
                break;
            case "iddown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('id', 'DESC')->get();
                break;
            case "fnameup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('fname', 'ASC')->get();
                break;
            case "fnamedown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('fname', 'DESC')->get();
                break;
            case "lnameup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('lname', 'ASC')->get();
                break;
            case "lnamedown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('lname', 'DESC')->get();
                break;
            case "emailup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('email', 'ASC')->get();
                break;
            case "emaildown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('email', 'DESC')->get();
                break;
            case "telup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('tel', 'ASC')->get();
                break;
            case "teldown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('tel', 'DESC')->get();
                break;
            case "urlup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('url', 'ASC')->get();
                break;
            case "urldown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('url', 'DESC')->get();
                break;
            case "createtup":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('created_at', 'ASC')->get();
                break;
            case "createddown":
                $arrCities = Recruiters::where('status', "!=", "99")->orderBy('created_at', 'DESC')->get();
                break;
            default:
                $arrCities = Recruiters::where('status', "!=", "99")->get();
        }


        return view('Recruiters.read_recruiters', ["arr" => $arrCities->toArray(), "stat"=>$this->statuscodes, "action"=>$action]);
    }
    public function read_one(Request $request, $id){
        $arrCities = Recruiters::where('id', $id)->get()->toJson();
        return $arrCities;
    }
    public function new_one(){
        return view('Recruiters.new_recruiters',["stat"=>$this->statuscodes]);
    }
    public function create_one(Request $request){
        $arrCities = new Recruiters;
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
        return redirect()->route('recruiters', ['action' => $request->input('action')] );
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
        $id = $request['id'];
        $arrCities = Recruiters::find($id);
        $arrCities->status          =   ("99");
        $rez = $arrCities->save();
        return redirect()->route('recruiters', ['action' => $request->input('action')] );
    }

}
