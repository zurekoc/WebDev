<?php
include("account.php") ;
include("myFunction.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

$db = mysqli_connect($hostname,$username,$password,$project);
if (mysqli_connect_errno())
  {	  
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 exit();
  }
print "Hello<br>" ;
print "<br>Successfully connected to MySQL.<br>";

mysqli_select_db( $db, $project );

$to = "mp634@njit.edu"  ;
$flag = false; 		
$UCID = GET("UCID",  $flag); 	
$amount = GET("amount", $flag);
$mail = GET("mail", $flag);
$type = GET("type", $flag);
$pass = GET("pass", $flag); 


$output="";
if ($flag) 
{ exit("<br>Failed: empty input field."); };

if(!authenticate($UCID,$pass,$db)){ exit("<br> Bad Credentials.");};
if (!enough ($UCID, $amount, $db) )
  {exit ("<br>Not enough ");};
if ($type == 'D')
  { deposit($UCID, $amount, $mail, $type, $output, $db);
	echo $output;
	$subject = "assignment1: Withdraw" ;
	mail (  $to, $subject, $output );
	};
		
if ($type == 'W')
  {withdraw($UCID, $amount, $mail, $type, $output,  $db);
	echo $output;
	$subject = "assignment1: Withdraw" ;
	mail (  $to, $subject, $output );
	};
	
//mysqli_free_result($t);
mysqli_close($db);
exit ( "<br>Interaction completed.<br><br>"  ) ;
  ?>