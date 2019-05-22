<style>

	td{color:blue;}
	
	tr:nth-child(even) {background:lightgrey}
</style>

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
$output="";

$flag = false; 		
$UCID   = GET("UCID",  $flag); 	
$pass  = GET("pass", $flag);
$number  = GET("number", $flag);

if ($flag) {exit("<br>Failed: empty input field.");};	

echo ("<br>Succeeded<br>");	


if(!authenticate($UCID,$pass,$db)){ exit("<br> Bad Credentials.");};
print"<br>Welcome";
display($UCID, $number,$output,$db);
echo $output;

//mysqli_free_result($t);
mysqli_close($db);
exit ( "Interaction completed.<br><br>"  ) ;
  ?>