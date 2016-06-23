<?php
include_once('google.php');
$google = new Google();
 $google->get_access_token($_GET['code']);
 if($_SESSION['access_token'])
     header("location:home.php");
 