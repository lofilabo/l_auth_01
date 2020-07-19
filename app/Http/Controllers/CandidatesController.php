<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Candidates;
use App\Statuscodes;

class CandidatesController extends Controller
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
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('id', 'ASC')->get()->toArray();
                break;
            case "iddown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('id', 'DESC')->get()->toArray();
                break;
            case "fnameup":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('fname', 'ASC')->get()->toArray();
                break;
            case "fnamedown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('fname', 'DESC')->get()->toArray();
                break;
            case "lnameup":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('lname', 'ASC')->get()->toArray();
                break;
            case "lnamedown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('lname', 'DESC')->get()->toArray();
                break;
            case "emailup":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('email', 'ASC')->get()->toArray();
                break;
            case "emaildown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('email', 'DESC')->get()->toArray();
                break;
            case "telup":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('tel', 'ASC')->get()->toArray();
                break;
            case "teldown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('tel', 'DESC')->get()->toArray();
                break;
            case "urlup":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('url', 'ASC')->get()->toArray();
                break;
            case "urldown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('url', 'DESC')->get()->toArray();
                break;
            case "createtup":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('created_at', 'ASC')->get()->toArray();
                break;
            case "createddown":
                $arrCities = Candidates::where('status', "!=", "99")->orderBy('created_at', 'DESC')->get()->toArray();
                break;
            default:
                $arrCities = Candidates::where('status', "!=", "99")->get()->toArray();
        }
        
        return view('Candidates.read_candidates', ["arr" => $arrCities, "stat"=>$this->statuscodes, "action"=>$action]);
    }
    public function read_one($id){
        $arrCities = Candidates::where('id', $id)->get()->toJson();
        return $arrCities;
    }
    public function new_one(){
        return view('Candidates.new_candidates',["stat"=>$this->statuscodes]);
    }
    public function create_one(Request $request){
        $arrCities = new Candidates;
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
        return redirect()->route('candidates', ['action' => $request->input('action')] );
    }
    public function update_one(Request $request){
        //dd($request);

        $id = $request['modal-input-id'];
        $arrCities = Candidates::find($id);
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
        return redirect()->route('candidates', ['action' => $request->input('action')] );
    }
    public function delete_one(Request $request){
        $id = $request['id'];
        $arrCities = Candidates::find($id);
        $arrCities->status =   ("99");
        $rez = $arrCities->save();
        return redirect()->route('candidates', ['action' => $request->input('action')] );
    }

}
