<?php

/**
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
  */
 set_time_limit(3000); 
 /* connect to gmail with your credentials */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'amitraky@gmail.com'; # e.g somebody@gmail.com
$password = '9161464550';
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
$emails = imap_search($inbox,'ALL');
/* useful only if the above search is set to 'ALL' */
$max_emails = 15;
/* if any emails found, iterate through each email */
if($emails) {
    $count = 1;
	
        /* put the newest emails on top */
    rsort($emails);
        /* for every email... */
	foreach($emails as $email_number) 
    {
        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);
        /* get mail message */
		echo print_r(@$overview[0]->subject)."<hr><br>";
        $message = imap_fetchbody($inbox,$email_number,1);
       //echo $message; 
        if($count++ >= $max_emails) break;
    }
  } 
/* close the connection */
imap_close($inbox);
echo "Done";