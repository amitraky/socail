<?php 

require_once 'src/Facebook/autoload.php';
session_start();
class Facebook{
   
   public $fb;
   
   public function __construct(){
    
	 $this->fb = new Facebook\Facebook([
                                   'app_id' => '1723551001246878',
   									'app_secret' => '93186dd927ab919127ec1903e4d7ef2b',
                                     'default_graph_version' => 'v2.5',
                                 ]);
	
   }
   
   
   public function login(){
   
     $helper = $this->fb->getRedirectLoginHelper();
	 $permissions = ['public_profile','email']; // optional
	 return $helper->getLoginUrl('http://localhost/kickmobis/auth/fb_callback', $permissions);  
   
   }
   public function get_access_token($code){
   
   # login-callback.php
	
	$helper = $this->fb->getRedirectLoginHelper();
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
	
	if (isset($accessToken)) {
	  // Logged in!
	  $_SESSION['facebook_access_token'] = (string) $accessToken;
	
	  // Now you can redirect to another page and use the
	  // access token from $_SESSION['facebook_access_token']
}
   
  
   }
   
   public function set_access_token(){
      $this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
   
   }
   
   
   public function get_user_profile(){
	    $response = $this->fb->get('/me?fields=email,name,phone_number');
		return json_decode($response->body,true);
	   
   }
    
   
   
}