<?php

print "Hello<br>" ;
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);
include (  "account.php"     ) ;
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "<br>Successfully connected to MySQL.<br>";
print "<br>Form inputs are:<br><br>";
mysqli_select_db( $db, $project ); //standard code to get from the database


function insert (  $UCID, $pass, $name, $db )
{
	$s   =  "insert into students values ( '$UCID', '$pass', '$name') " ;
	print "<br>SQL insert statement is: $s<br>"; 
	echo "<br>insert succeeded<br><br>";
}

function GET($name, &$flag){
	global $db ;
	$v = $_GET [$name];
	$v = trim ( $v );
	if ($v == "") 
	  { $flag = true ; echo "<br><br>$name is empty." ; return  ;} ;
	$v = mysqli_real_escape_string ($db, $v );
	echo "<br>$name is $v."  ;
	return $v; 
	//Retrieves data by name and returns its value
	//Sets flag  to true if input is 'bad' 
}


$flag = false; 						//Initialize 

$UCID  = GET("UCID", $flag);	 	//Access data by name
$pass   = GET("pass",  $flag); 	
$name   = GET("name",  $flag); 	
$amount   = GET("amount",  $flag); 	



//Exit if any data was "bad"
if ($flag) {exit("<br>Failed: empty input field.");};	
//Get data



date_default_timezone_set ("America/New_York");
$tdate = "<br><i>recent</i> is initialized to: " . date("l jS \of F Y h:i:s A") . "<br><br>" ;
echo $tdate ;

$s = "insert into AA values ('$UCID', '$pass', '$name' )"; 
//current and recent in AA
//insert record of transaction in TT


$s = " insert into TT values ('$UCID' , 'D', $amount, NOW(), 'N')";
echo "SQl insert statement is: $s  <br>";
echo "SQL insert TT statement was transmitted for execution. <br><br>" ;

$s = " update AA set recent = NOW(), current1 = '$amount' + current1 where UCID = '$UCID'     ";
echo "SQl update AA statement is: $s <br>";
echo "SQL statment was transmitted for execution. <br><br>" ;

($t = mysqli_query ( $db,  $s   ) )  or die( mysqli_error($db) );
print "<br><br>Bye" ;
//mysqli_free		_result($t);
mysqli_close($db);
exit ( "<br>Interaction completed.<br><br>"  ) ;

?>









