<?php
include('facebook.php');
$fb = new Facebook();
?> <a href="<?=$fb->login()?>">Login</a>