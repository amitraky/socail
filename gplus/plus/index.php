<?php
include_once('google.php');
$google = new Google();
?><a href="<?=$google->login();?>">Login</a>