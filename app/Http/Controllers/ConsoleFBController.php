<?php
/*
ACCESS TOKEN FOR ADACCOUNT
EAAC0gSMJDt0BABSmyX0RmI0TSyk5cZC6wnjaCCI9hLpoEZCgdpfATulxId6Esbvve59NC3wAJZBmll8DbfgNnZBop66aEgcgSvb8rnojmgQx8gOZCDHRGQN1qwEJpUMncSZBZAF02UqHGDNl80LHOxK9CWsZA0CZBNEioyc8DZBKboqmrnJ8qpVjuT


New Sandbox Ad Account (3028605297234815)


Sandbox Account Access Token

EAAMRT6a6vqEBAPJkLjlSmIBO83FCTvnO0p66u54RnxyXKKiVDubInTToJvmKnxbJyZACb7YYtIhUfKLOUXrXGsNcyinkHvpPJkQ389ZAdm7ZCQVnbrPKsUZCkuW4X5PTYj0FeHj7ZAicff3ZCDMY0ddlZAoZApnLr3FaJ4l6aYOYsHp5jxZCzTydCr0qmJFwZBUjIZD

*/
namespace App\Http\Controllers;

/*
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
*/

use Illuminate\Http\Request;
use Facebook\Facebook;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\User as AdUser;
use FacebookAds\Object\Fields\AdUserFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Campaign;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use FacebookAds\Object\Ad;
use FacebookAds\Object\Lead;
use FacebookAds\Object\AdCampaign;
use FacebookAds\Object\Fields\AdCampaignFields;
use FacebookAds\Object\Fields\AdSetFields;

use Config;

class ConsoleFBController extends Controller
{
/*iHolon - test01
	protected $access_token = '198466731577053|SgYr7pom7LGdP7u6gX39VO_fU0A';
	protected $app_secret = '278680303437374489785d5be0a3f602';
	protected $app_id = '198466731577053';
	protected $id = '317724085917897';
*/
	//iHolon01
	protected $access_token = 'EAAMRT6a6vqEBAI6J4IBEHUcZAIygCEND48VFmuqKaBWtqDfNxQgFzGUU08kgPUhE8c5T4RO6JH6fJZCUeF7QUzzYlqs2rDLO2rnZADOrTA7WHN0OkVgrEdco7r2iX3Cp9dkEoKKecJMfSqWB3IY6EZC3phLku4m2ZCqhsZA1ax8gvgvzNZBvsNU';
	protected $app_secret = 'a2838279b74a8ef66a7650ad4ba613e9';
	protected $app_id = '863458727476897';
	protected $id = '317724085917897';

/*
	protected $access_token = 'EAAMRT6a6vqEBAPJkLjlSmIBO83FCTvnO0p66u54RnxyXKKiVDubInTToJvmKnxbJyZACb7YYtIhUfKLOUXrXGsNcyinkHvpPJkQ389ZAdm7ZCQVnbrPKsUZCkuW4X5PTYj0FeHj7ZAicff3ZCDMY0ddlZAoZApnLr3FaJ4l6aYOYsHp5jxZCzTydCr0qmJFwZBUjIZD';
	protected $ad_account_id = 'act_3028605297234815';
	protected $app_secret = 'a2838279b74a8ef66a7650ad4ba613e9';
	protected $app_id = '863458727476897';
*/
/*
	protected $access_token = null;
	protected $app_secret = null;
	protected $app_id = null;
	protected $id = null;
*/
    public function __construct(){

        $this->middleware('auth');
        //$this->middleware('auth:admin');

		if (!session_id()) {
		    session_start();
		}
//		dd(config('ACCESS_TOKEN',false));
/*
		$this->access_token = config('access_token');
		$this->app_secret = config('app_secret');
		$this->app_id = config('app_id');
		$this->id = config('id');
*/
		$this->fb = new Facebook([
		  'app_id' => $this->app_id,
		  'app_secret' => $this->app_secret,
  		  'default_graph_version' => 'v2.10',
  		      'persistent_data_handler'=>'session'
		]);

    }

    public function index(){

		if (!session_id()) {
		    session_start();
		}


/*
		$fb = new Facebook([
		  'app_id' => $this->app_id,
		  'app_secret' => $this->app_secret,
  		  'default_graph_version' => 'v2.10',
		]);
*/
		$fb = $this->fb;
		$helper = $fb->getRedirectLoginHelper();
		if (isset($_GET['state'])) {
		    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
		}		

		if (!isset($_SESSION['facebook_access_token'])) {
		  $_SESSION['facebook_access_token'] = null;
		}

		if (!$_SESSION['facebook_access_token']) {
		  $helper = $fb->getRedirectLoginHelper();
		  try {
		    $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken();
		  } catch(FacebookResponseException $e) {
		    // When Graph returns an error
		    echo 'Graph returned an error: ' . $e->getMessage();
		    exit;
		  } catch(FacebookSDKException $e) {
		    // When validation fails or other local issues
		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
		    exit;
		  }
		}

		if ($_SESSION['facebook_access_token']) {
		  //echo "You are logged in!";
		  return($this->good_stuff());
		  //$this->samplecode_from_fb();

		} else {
		  $permissions = ['ads_management'];
		  $baseurl = $this->getBaseUrl();
		  //$baseurl = 'http://localhost:8000';
		  $loginUrl = $helper->getLoginUrl($baseurl . '/console/marketing-api', $permissions);
		  $arrCities = '<a href="' . $loginUrl . '">Log in with Facebook</a>';
		  return view('Console.fb', ["lit" => $arrCities, "nuf" => '']);
		}
		
        
    }

    public function getBaseUrl(){
	    if(isset($_SERVER['HTTPS'])){
	        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	    }
	    else{
	        $protocol = 'http';
	    }
	    return $protocol . "://" . $_SERVER['HTTP_HOST'] ;

	}

    public function marketingapi(){
		
		if (!session_id()) {
		    session_start();
		}

/*
		$fb = new Facebook([
		  'app_id' => $this->app_id,
		  'app_secret' => $this->app_secret,
  		  'default_graph_version' => 'v2.10',
		]);
*/
		$fb = $this->fb;



				$helper = $fb->getRedirectLoginHelper();
				 
				try {
				  $accessToken = $helper->getAccessToken();
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
				  // When Graph returns an error
				  echo 'Graph returned an error: ' . $e->getMessage();
				  exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
				  // When validation fails or other local issues
				  echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
				}
				 
				if (! isset($accessToken)) {
				  if ($helper->getError()) {
				    header('HTTP/1.0 401 Unauthorized');
				    echo "Error: " . $helper->getError() . "\n";
				    echo "Error Code: " . $helper->getErrorCode() . "\n";
				    echo "Error Reason: " . $helper->getErrorReason() . "\n";
				    echo "Error Description: " . $helper->getErrorDescription() . "\n";
				  } else {
				    header('HTTP/1.0 400 Bad Request');
				    echo 'Bad request';
				  }
				  exit;
				}
				 
				// Logged in


				//echo '<h3>Access Token</h3>';
				//var_dump($accessToken->getValue());
				 
				// The OAuth 2.0 client handler helps us manage access tokens
				$oAuth2Client = $fb->getOAuth2Client();
				 
				// Get the access token metadata from /debug_token
				$tokenMetadata = $oAuth2Client->debugToken($accessToken);
				//echo '<h3>Metadata</h3>';
				//var_dump($tokenMetadata);
				$_SESSION['facebook_access_token'] = (string) $accessToken;

				Api::init(
				  $this->app_id,
				  $this->app_secret,
				  $_SESSION['facebook_access_token'] // Your user access token
				);
				$arrCities = print_r($oAuth2Client->debugToken($accessToken), true);
				$arrTowns  = print_r($accessToken->getValue(), true);

				$_SESSION['facebook_details_1'] = $oAuth2Client->debugToken($accessToken);
				$_SESSION['facebook_details_2'] = $accessToken->getValue();

				$arrTowns = json_encode($arrTowns, JSON_PRETTY_PRINT);
				
				return view('Console.fb', ["lit" => $arrTowns, "nuf" => $arrCities ]);


				/* 
				// Validation (these will throw FacebookSDKException's when they fail)
				$tokenMetadata->validateAppId($config['app_id']);
				// If you know the user ID this access token belongs to, you can validate it here
				//$tokenMetadata->validateUserId('123');
				$tokenMetadata->validateExpiration();
				 
				if (! $accessToken->isLongLived()) {
				  // Exchanges a short-lived access token for a long-lived one
				  try {
				    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
				  } catch (Facebook\Exceptions\FacebookSDKException $e) {
				    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
				    exit;
				  }
				 
				  echo '<h3>Long-lived</h3>';
				  var_dump($accessToken->getValue());
				}
				 
				$_SESSION['fb_access_token'] = (string) $accessToken;
				 
				// User is logged in with a long-lived access token.
				// You can redirect them to a members-only page.
				//header('Location: https://example.com/members.php');

				*/

    }


    public function samplecode_from_fb(){

			$api = Api::init($this->app_id, $this->app_secret, $this->access_token);
			$fields = array(
			);
			$params = array(
			);

			$account = new AdAccount($this->ad_account_id);

			$adsets = $account->getAdSets(array(
			  AdSetFields::NAME,
			  AdSetFields::CONFIGURED_STATUS,
			  AdSetFields::EFFECTIVE_STATUS,
			));
			echo json_encode($adsets, JSON_PRETTY_PRINT);
			
			echo json_encode($account->getInsights( $fields, $params )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    }


    public function good_stuff(){
		if (!session_id()) {
		    session_start();
		}
		/*
		Api::init(
		  $this->app_id,
		  $this->app_secret,
		  $_SESSION['facebook_access_token'] // Your user access token
		);
		*/  

		$api = Api::init( $this->app_id, $this->app_secret, $this->access_token ); 
		
		$fields = array();
		$params = array();

		//$me = new AdUser('me');
		//$accounts = $me->getAdAccounts();

		$fb = $this->fb;
		$fb->setDefaultAccessToken( $_SESSION['facebook_access_token']);
		
		//THINGS THAT WORK....

  		$res = $fb->get('/me');

		//$res = $fb->get('/me?fields=birthday');
		//$res = $fb->get('/me?fields=email');
		//$res = $fb->get('/me?fields=hometown');
		//$res = $fb->get('/105832091202741/photos?fields=height,width');
		//$res = $fb->get('/me/adaccounts');
		//END OF THINGS THAT WORK
		//$node = $res->getGraphObject();
		
		//$me = new AdUser('me');
		
		//$aaa = $me->getAdAccounts()->current();
		$arrCities = print_r($res, true);
		//dd($node); 	
		//$bh = $_SESSION['facebook_details_1'];
		//dd( $res );
		
		//dd($_SESSION['facebook_details_2']);
		return view('Console.fb', ["lit" => '', "nuf" => $arrCities ]);

    }

    public function log_out_of_fb(){
    	if (!session_id()) {
		    session_start();
		}
/*
		$fb = new Facebook([
		  'app_id' => $this->app_id,
		  'app_secret' => $this->app_secret,
		  'default_graph_version' => 'v2.10',
		]);
*/
		$fb = $this->fb;
		$helper = $fb->getRedirectLoginHelper();
		$baseurl = $this->getBaseUrl();
		$logoutUrl = $helper->getLogoutUrl($_SESSION['facebook_access_token'], $baseurl . '/console/fb');
		echo '<a href="' . $logoutUrl . '">Logout of Facebook!</a>';
    }
}
