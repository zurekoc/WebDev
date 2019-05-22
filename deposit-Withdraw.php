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
	$amount = GET("amount", $flag);
	$mail= GET("mail", $flag);
	$type= GET("type", $flag);
	$output= GET("output", $flag);
if ($flag) {
	exit("<br>Failed: empty input field.");
}
if ( ! authenticate ($UCID, $pass, $db ) ) {
	exit( "bad cred"  );}
if (enough($UCID, $amount, $db)) {
	echo "can withdraw";
}
else {
	echo "canNOT withdraw";
}
echo "<br>Bye! <br>";
deposit( ($UCID, $amount, $type, $mail, $output, $db);
withdraw ($UCID, $amount, $mail, $type, $output, $db );

echo"<br>Withdraw done!!<br>";
mysqli_free_result($t);
mysqli_close($db);

?>