<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notes;

class Note_Base_Controller extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        return view('test', ["whoami" => "I am the Blasphemer"]);
    }

    public function read_many(Request $request, $id=null){
        
        if(!$id){
            $id = $request->input('docid');
        }

        $arrCities = Notes::get();

        if($id != null){
            $arrCities = $arrCities->where('parent_id', '=', $id);
        }
        $arrCities = $arrCities->where('parent_note_id', '=', null);
        return view('Notes.Notes.notes_read', ["arr" => $arrCities->toArray(), 'action' => $request->input('action'), "noteType"=>"general" ]);

    }

    public function get_read_many(Request $request){
        
        $id = $request->input('docid');
            dd($id) ;

        $arrCities = Notes::get();

        if($id != null){
            $arrCities = $arrCities->where('parent_id', '=', $id);
        }
        $arrCities = $arrCities->where('parent_note_id', '=', null);
        return view('Notes.Notes.notes_read', ["arr" => $arrCities->toArray() ]);

    }

    public function read_one(Request $request, $id){

        $arrCities = Notes::where('id',  $id)->get()->toJson();
        return $arrCities;

    }

    public function new_one(){

        return view('test',[]);

    }

    public function update_one(Request $request){

        $id = $request['modal-input-id'];
        $arrCities = Notes::find($id);
        $rez = $arrCities->save();
        return redirect()->route('notes' );

    }

    public function delete_one(Request $request){

        $id = $request['id'];
        $arrCities = Notes::find($id);
        $rez = $arrCities->save();
        return redirect()->route('notes');

    }

}
