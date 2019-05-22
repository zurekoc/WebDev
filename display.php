<?php
include (  "account.php"     ) ;
include (  "myFunctions.php"     ) ;
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

$flag = false;
	$UCID = GET("UCID", $flag);
	$number=GET("number", $flag);
	$output= GET("output", $flag);
if ($flag) {
	exit("<br>Failed: empty input field.");
}
if ( ! authenticate ($UCID, $pass, $db ) ) {
	exit( "bad cred"  );}
display ($UCID, $number, $output, $db );
mysqli_free_result($t);
mysqli_close($db);
?>