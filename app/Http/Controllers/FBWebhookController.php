<?php


/*

Sticky things about this application....

VIZ: ACTING AS AN ENDPOINT FOR FB WEB HOOKS
If you try to use a route in the web... router, it WILL NOT WORK, EVER.
You'll need routes in the api... router.  The FB validator uses a GET 
call to challenge-request, and a POST after that, hence the 2 different methods.

DB.

The dbtest method is NOT for any sort of production use and should never have
a real, permanent route connected to it.  It's for playing with the model because 
getting meaningful feedback from a FB request is impossible.

SERVER SETUP.
To act as a web hook endpoint, this class has to live at the end of a https://...
domain.  Follow these steps to run the domain.

1. Run NGROK on port 443:
ngrok http 443

Ngrok will not assign to port 443; but it will report what port it is using, like this:
Forwarding                    http://e7bd9dde3392.ngrok.io -> http://localhost:52596                    
Forwarding                    https://e7bd9dde3392.ngrok.io -> http://localhost:52596  

These two work:
sudo php artisan serve --port 52596
ngrok http 52596

We want the one associated with https://, obviously.

2. Run artisan-serve with the specified port, in this example 52596:
sudo php artisan serve --port=52596

3. Register the endpoint with FB.

At:
https://developers.facebook.com/ ---> webhooks,
'Edit Subscription'
Our route is in the api router, so needs the API prefix.
It will look like this:
https://f17a73452646.ngrok.io/api/fbwebhook
   ^---------------------------^----------------------IMPORTANT!

This only needs to be set in the one place.  Routing cleverness will
discriminate on the GET / POST part and send FB's call to the correct
controller method.


IF NONE OF THIS IS BEHAVING and you want to untangle the insanity, this is the bare-minimum php
needed to get communication with FB.  Run it with php -S on an NGROK-forwarded https port,
and you will get output to the shell.  Don't even bother with Laravel, just copy to a file 
and run it from there. 
(if your filename is thingy.php, the endopint you tell FB must be:
https://f17a73452646.ngrok.io/thingy.php
and the token must be 123456
)

    $challenge = $_REQUEST['hub_challenge'];
    $verify_token = $_REQUEST['hub_verify_token'];

    if ($verify_token === '123456') {
    echo $challenge;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    error_log(print_r($input, true));



*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fb_leads;

class FBWebhookController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('auth:admin');
    }

    public function getindex(Request $request){

        $challenge = $_REQUEST['hub_challenge'];
        $verify_token = $_REQUEST['hub_verify_token'];

        if ($verify_token === '123456') {
            error_log("VERIFYING!!");
            echo $challenge;
        }
        $input = $request->getContent();
        error_log(print_r($input, true));
    }

    public function postindex(Request $request){

    $fileHandle = fopen('dbgdmp.txt', 'a+');
    $result = fwrite ($fileHandle , "\n");
    


        $input = $request->getContent();

        $result = fwrite ($fileHandle , $input . "\n\n");


        if(strpos($input, 'leadgen')!=FALSE){
            $this->handleLead($input);
        }else{
            error_log($input);              
        }
      
    }


    public function handleLead($leadstr){

        $leadobj = json_decode($leadstr, true);
        error_log(print_r($leadobj, true));


            /*
            The 'lead' is a JSON object which we break into a PHP array like this:

            [Fri Jul 10 17:56:00 2020] Array
            (
                [object] => page
                [entry] => Array
                    (
                        [0] => Array
                            (
                                [id] => 0
                                [time] => 1594400059
                                [changes] => Array
                                    (
                                        [0] => Array
                                            (
                                                [field] => leadgen
                                                [value] => Array
                                                    (
                                                        [ad_id] => 444444444
                                                        [form_id] => 444444444444
                                                        [leadgen_id] => 444444444444
                                                        [created_time] => 1594400059
                                                        [page_id] => 444444444444
                                                        [adgroup_id] => 44444444444
                                                    )
                                            )
                                    )
                            )
                    )
            )


            */


        $entryobj = $leadobj['entry'];
        foreach($entryobj as $entry){
            error_log(print_r($entry, true));
            $changesobj = $entry['changes'];
            foreach($changesobj as $change){
                error_log(print_r($change, true));
                /*
                error_log(print_r( $change['value']['ad_id'], true ));
                error_log(print_r( $change['value']['form_id'], true ));
                error_log(print_r( $change['value']['leadgen_id'], true ));
                error_log(print_r( $change['value']['created_time'], true ));
                error_log(print_r( $change['value']['page_id'], true ));
                error_log(print_r( $change['value']['adgroup_id'], true ));
                */
                $fbl = New Fb_leads;
                $fbl->ad_id         =   $change['value']['ad_id'];
                $fbl->form_id       =   $change['value']['form_id'];
                $fbl->leadgen_id    =   $change['value']['leadgen_id'];
                $fbl->created_time  =   $change['value']['created_time'];
                $fbl->page_id       =   $change['value']['page_id'];
                $fbl->adgroup_id    =   $change['value']['adgroup_id'];
                $fbl->save();  
            }
        }

    }
}
