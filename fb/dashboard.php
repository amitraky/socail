<?php
include('facebook.php');
$fb = new Facebook();
$fb->set_access_token();
$data = $fb->get_user_profile();

print_r($data);