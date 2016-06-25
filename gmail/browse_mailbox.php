<?php
/*
 * browse_mailbox.php
 *
 * @(#) $Header: /opt2/ena/metal/pop3/browse_mailbox.php,v 1.2 2014/01/27 10:53:45 mlemos Exp $
 *
 */

?><html>
<head>
<title>Parsing a message with Manuel Lemos' PHP POP3 and MIME Parser classes</title>
</head>
<body>
<center><h1>Parsing a message with Manuel Lemos' PHP POP3 and MIME Parser classes</h1></center>
<hr />

<?php

	require('mime_parser.php');
	require('rfc822_addresses.php');
	require("pop3.php");

  /* Uncomment when using SASL authentication mechanisms */
	/*
	require("sasl.php");
	*/

	//stream_wrapper_register('mlpop3', 'pop3_stream');  /* Register the pop3 stream handler class */

	$pop3=new pop3_class;
	$pop3->hostname="pop.gmail.com";             /* POP 3 server host name   */
	$pop3->port=995;                         /* POP 3 server host port,
	                                            usually 110 but some servers use other ports
	                                            Gmail uses 995                              */
	$pop3->tls=1;                            /* Establish secure connections using TLS      */
	$user="amitferryipl@gmail.com";                        /* Authentication user name  */
	$password="Cure_123";                    /* Authentication password                 */
	$pop3->realm="";                         /* Authentication realm or domain              */
	$pop3->workstation="";                   /* Workstation for NTLM authentication         */
	$apop=0;                                 /* Use APOP authentication                     */
	$pop3->authentication_mechanism="USER";  /* SASL authentication mechanism               */
	$pop3->debug=1;                          /* Output debug information                    */
	$pop3->html_debug=1;                     /* Debug information is in HTML                */
	$pop3->join_continuation_header_lines=1; /* Concatenate headers split in multiple lines */
	$data = array();
	

	if(($error=$pop3->Open())=="")
	{
		if(($error=$pop3->Login($user,$password,$apop))=="")
		{
			
			
			
			if(($error=$pop3->Statistics($messages,$size))=="")
			{
				
				   
				
				if($messages>0)
				{
					$pop3->GetConnectionName($connection_name);
					$num = $messages > 10 ? 1 : 1;
					
					for($i=0; $i<= $num; $i++){						
					$message= 1 ;
					
					$message_file='mlpop3://'.$connection_name.'/'.$message;
					$mime=new mime_parser_class;
					
					/*
					* Set to 0 for not decoding the message bodies
					*/
					$mime->decode_bodies = 5;

					$parameters=array(
						'File'=>$message_file,

						/* Read a message from a string instead of a file */
						 //'Data'=>'My message data string',              

						/* Save the message body parts to a directory     */
						 //'SaveBody'=>'/tmp',                            

						/* Do not retrieve or save message body parts     */
							'SkipBody'=>'',
					);
					 
					 
					$success = $mime->Decode($parameters, $decoded); 
					var_dump($mime);die;
					
					if(!$success)
						echo '<h2>MIM';
					else
					{
					
						if($mime->Analyze($decoded[0], $results))
						{
							print_r($results);
							die;
						  
						}
					}
				
				
				}			
			    
				}else
				 echo "<h1> Mail is Empty</h1>";
		?><?php
			 
		  if(database($data))
		     echo "<h3> Success</h3>";
		  else 
		    echo "<h3>Error !</h3>";	 
			}
		}
	}
	if($error!="")
		echo "<H2>Error: ",HtmlSpecialChars($error),"</H2>";


 function database($data=null)
{
  $rwData = array();	
  foreach($data as $value)
    $rwData[] =  "(".implode(',' ,$value).")"; 
  $rw = implode(',',$rwData);
 
  $mysqli = new mysqli('localhost','root','','test');
  $q = "INSERT INTO `mail` (`to`,`from`,`subject`,`message`,`mail_date`,`date`)VALUES {$rw}";
  if($mysqli->query($q))
  return 1;
  
}

function html_parse($html)
{
   /*** a new dom object ***/ 
   $dom = new domDocument; 
   /*** load the html into the object ***/ 
   @$dom->loadHTML($html); 
   
   /*** discard white space ***/ 
   $dom->preserveWhiteSpace = false; 
   
   /*** the table by its tag name ***/ 
   $tables = $dom->getElementsByTagName('table'); 
   
   
   /*** get all rows from the table ***/ 
   $rows = $tables->item(0)->getElementsByTagName('tr'); 
   /*** loop over the table rows ***/ 
   foreach ($rows as $row) {
      /*** get each column by tag name ***/ 
      $cols = $row->getElementsByTagName('td'); 
	  print_r($row->nodeValue);
   }

}


?>
