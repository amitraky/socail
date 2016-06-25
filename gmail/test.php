<?php

$n =  50;

for($i = 0; $i <= $n; $i++)
{
   

}
$mailserver="mail.ferryipl.com"; 
$port="110/pop3"; 
$user="taru@ferryipl.com"; 
$pass="india_123"; 
  
if ($mbox=imap_open( "{" . $mailserver . ":" . $port . "}INBOX", $user, $pass )) 
{  echo "Connected\n"; 
         
    $check = imap_mailboxmsginfo($mbox); 
	
	print_r($check);
          
    echo "Date: "     . $check->Date    . "<br />\n" ; 
    echo "Driver: "   . $check->Driver  . "<br />\n" ; 
    echo "Unread: "   . $check->Unread  . "<br />\n" ; 
    echo "Size: "     . $check->Size    . "<br />\n" ; 
         
    imap_close($mbox); 
} else { exit ("Can't connect: " . imap_last_error() ."\n");  echo "FAIL!\n";  }; 
?>