<?php
include_once('google.php');
$google = new Google();
$data = $google->set_access_token();
$data = $google->get_user_details();
 print_r($data);