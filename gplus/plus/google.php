<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_PlusService.php';
session_start();

class Google
{
	
 public $client;
 
 public $plus;
	
 public function __construct(){
	 
	$this->client = new Google_Client();
	$this->client->setScopes('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.profile');
	//$client->setApplicationName("Google+ PHP Starter Application");
	$this->plus = new Google_PlusService($this->client);
	
 }
 
 
 public function login(){
  return $this->client->createAuthUrl();
 }

 public function get_access_token($code){
	 
  $this->client->authenticate($code);
  $_SESSION['access_token'] = $this->client->getAccessToken(); 
  print_r($_SESSION['access_token']);
  die;
 }

 public function set_access_token(){
     if($_SESSION['access_token'])
        $this->client->setAccessToken($_SESSION['access_token']); 
 }
 
 public function logout(){
 //
 }
 
 public function get_user_details(){
  return $this->plus->people->get('me');    
 }
 
 


}

