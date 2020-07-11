<?php


/*

Sticky things about this application....
See the notes in FBWebhooksController.

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fb_leads;

class FBConsoleController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function read_leads(){
        $arrCities = Fb_leads::get()->toArray();
        return view('Fb_leads.read_leads', ["arr" => $arrCities]);
    }


    public function testdb(){
        $fbl = New Fb_leads;
        $fbl->ad_id         = "1";
        $fbl->form_id       = "2";
        $fbl->leadgen_id    = "3";
        $fbl->created_time  = "4";
        $fbl->page_id       = "5";
        $fbl->adgroup_id    = "6";
        $fbl->save();        
    }

}
