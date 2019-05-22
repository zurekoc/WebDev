<?php
session_start() ;

//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
//ini_set('display_errors' , 1);

$UCID   = $_GET["UCID"]; echo "<br>user is $UCID<br>";
$pass  = $_GET["pass"];  echo "<br>pass is $pass<br><br>";
$delay  = $_GET["delay"];  echo "<br>delay is $delay<br><br>";

$delay=7;

$text=$_SESSION["captcha"];

   
if($pass!="007") {
		echo"<br>You do not have the right credentials!<br>";
		header("refresh: $delay; url=login.html");
		exit();
		} 
else{
	$_SESSION['logged']=true;
	$_SESSION['UCID']=$UCID;
	
	echo"<br>good cred- being allowed entry in a moment <br><br>";
	header("refresh: $delay; url=transaction.php");
	exit();
}
?>


