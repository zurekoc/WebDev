<?php
include (  "account.php"     ) ;
include (  "muFunctions.php"     ) ;

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);
//databse connection code
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit(); 
  }
print "<br>Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project ); 
$UCID = $_GET [  "UCID"   ] ; 
$pass = $_GET [  "pass"   ] ;
$pass2 = $_GET [  "pass2"   ] ;   
$name = $_GET [  "name"   ] ;   
$mail_address = $_GET [  "mail_address"   ] ;   
$initial = $_GET [  "initial"   ] ; 

insert($UCID, $pass, $pass2, $name, $mail_address, $initial,$db);
echo "Completed!!";
mysqli_close($db);
?>
