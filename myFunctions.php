<?php
//GET function
function GET($name, $flag){
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
//authenticate function
function authenticate ( $UCID, $password, $db ) 
{    
    global $t;
	$s = " select * from AA where UCID='$UCID' and pass='$password'  ";
    print "<br><br>SQL select is: $s<br>";
    ($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );
	$num = mysqli_num_rows ($t);
	if($num == 0 ) {
		return false;
	}
	else {
	   return true;
	}
}

//display function
function display ($UCID, $number, $output, $db ) //fix this!!
{
	//$output="";
	$s = " select * from TT where UCID='$UCID' and amount=$amount and mail=$mail and type=$type";
	echo "<br>SQL select is: $s<br><br>";
	($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );
	$r = " select * from AA where UCID='$UCID' ";
    echo "<br><br>SQL select is: $r<br>";
	//$to = "mp634@njit.edu"  ;      $subject = "Assignment 1" ;
    //mail (  $to, $subject, $output );

	//echo "<br>$output<br>";
	($t = mysqli_query ($db, $r ) ) or die ( mysqli_error ($db) );
	$number = mysqli_num_rows ($t);
	echo "There were $number rows retrieved from DB table.<br><br>";
	if( $number==0) { echo "<br>No rows retrieved. <br>"; return ; } ;

	print"<table  border=2>";
	print"<td>UCID</td><td>number</td><td>output</td>";
		
	while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) 
	 {
		$UCID 	= $r[ "UCID" ]	; 
		$number = $r[ "number" ]	;  	
		$output 	= $r[ "output" ]	;  	
		print"<tr>";
		echo "<td>$UCID</td>";
		echo "<td>$number</td>";
		echo "<td>$output</td>";
		print"</tr>";
	};
		print"</table><br>";
}
//insert function
function insert($UCID, $pass, $pass2, $name, $mail_address,$initial,$db) {
$s = "insert into AA values ('$UCID', '$pass', '$pass2', '$name', '$mail_address','$initial')"; 
 print "<br>SQL insert statement is: $s<br>";
($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );
}
//deposit
function deposit($UCID, $amount, $type, $mail, $output, $db) {
	//$output="";
	$s = " insert into TT values('$UCID', '$type', '$amount', NOW(), '$mail')";
	echo "<br>SQL insert statement is: $s";
	echo "<br>SQL statement was transmitted for execution.<br>";
	//$to = "mp634@njit.edu"  ;      $subject = "Assignment 1" ;
    //mail (  $to, $subject, $output );
	($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );		

$s = " update AA SET recent=NOW(), current=current1 + '$amount' where UCID = '$UCID'";
	echo "<br>SQL update AA statement is: $s";
	echo "<br>SQL statement was transmitted for execution.<br>";
	($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );		
	//echo"<br>$output<br>";

}
//enough function
function enough($UCID, $amount, $db) {
	$s = "select * from AA where UCID = '$UCID' and current >= '$amount'";
	echo "<br>$s<br>";
	($t = mysqli_query ($db, $s)) or die(mysqli_error($db));
	$num = mysqli_num_rows($t);
	if ($num>0) {return true;} else {return false;}
}
//Withdraw Function 
function withdraw ($UCID, $amount, $mail, $type, $output, $db ) 
{
	//$output="";
	$s = " insert into TT values('$UCID', '$type', '$amount', NOW(), '$mail')";
	 echo "<br>SQL insert statement is: $s";
	echo "<br>SQL statement TT statement was transmitted for execution.<br>";
	($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );
	$s = " update AA SET recent=NOW(), current=current1-'$amount' where UCID = '$UCID'";
echo "<br>SQL update AA statement is: $s";
echo "<br>SQL statement was transmitted for execution.<br>";
	($t = mysqli_query ($db, $s ) ) or die ( mysqli_error ($db) );	
	echo "<br><br>SQL select is: $r<br>";
	//$to = "mp634@njit.edu"  ;      $subject = "Assignment 1" ;
    //mail (  $to, $subject, $output );
	//echo"<br>&$output<br>";
}
mysqli_free_result($t);
mysqli_close($db);

?>