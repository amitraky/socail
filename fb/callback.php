<?php 
include("facebook.php");

$fb = new Facebook();
$fb->get_access_token($_GET['code']);

if(  $_SESSION['facebook_access_token'])
    header("location:dashboard.php");
