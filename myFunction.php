<?php
function GET($field, &$flag)
{
  global $db;
  $n = $_GET [$field];
  $n = trim ($n);
  
  if ($n == "")
  { $flag = true; echo "<br><br> $field is empty." ;return; }
  $n = mysqli_real_escape_string($db, $n);
  echo "<br>$field is: $n" ;
  return $n;
}
//________________________________________________________________________________________ 
function authenticate($UCID , $pass, $db)
{
	global $t;
	$s = "select * from AA where UCID = '$UCID' and pass = '$pass'"; 
	print "<br>SQL select is: $s <br>";
	($t = mysqli_query($db, $s)) or die (mysqli_error($db));

	$num = mysqli_num_rows($t);
	print "<br>Number of rows retrieved is: $num <br>";
	
	if ($num == 0){return false;} else {return true;};
}
//________________________________________________________________________________________ 
function enough($UCID, $amount, $db) 
{
	$s = "select * from AA where UCID ='$UCID' and current1  <= '$amount'";
	echo "<br>$s<br>";
	($t = mysqli_query($db, $s))or die  (mysqli_error($db));
	
	$num = mysqli_num_rows($t);
	if ($num == 0) {return true;} else {return false;}
}
//________________________________________________________________________________________ 
function deposit($UCID, $amount ,$mail, $type, &$output,  $db)
{
	$output="";
	//Insert TT values
	$s = "insert into TT values ('$UCID','$type','$amount',NOW(), '$mail')";
    $output.="<br> SQL insert into TT is: $s <br>";
    ($t = mysqli_query ($db , $s )) or die (mysqli_error($db));
    $output.="<br> Transaction inserted for $UCID. <br><br>".
	//Update the AA table
	$s = " update AA SET current1 = current1 + $amount, recent = NOW()  where UCID = '$UCID'";
	$output.="<br><br> SQL update to AA is: $s <br><br>";
	($t = mysqli_query ($db , $s )) or die (mysqli_error($db));
}
//________________________________________________________________________________________ 
function withdraw($UCID, $amount ,$mail, $type, &$output,  $db)
{
	$output="";
	//Insert TT values
	$s = "insert into TT values ('$UCID','$type','$amount',NOW(), '$mail')";
    $output.="<br> SQL insert into TT is: $s <br>";
    ($t = mysqli_query ($db , $s )) or die (mysqli_error($db));
     $output.="<br> Transaction inserted for $UCID. <br><br>".
 	
	 //Update the AA table
	$s = " update AA SET  current1 = current1 -$amount, recent = NOW() where UCID = '$UCID'";
	$output.="<br><br> SQL update to AA is: $s <br>";
	($t = mysqli_query ($db , $s )) or die (mysqli_error($db));
}
//__________________________________________________________________________________________

function insert($UCID, $pass, $name, $mail, $initial, $current1, $plaintext, $db)
{
$s   =  "insert into AA values ( '$UCID', '$pass', '$name','$mail','$initial','$current1',NOW(),'$plaintext' ) " ;
print "<br>SQL insert statement is: $s<br>"; 
($t = mysqli_query ( $db,  $s   ) )  or die( mysqli_error($db) );
echo "<br>insert succeeded<br><br>";

}
//______________________________________________________________________________________________
function display($UCID, $number,&$output, $db)
{
	global $t;	
	$output="";
	$s = "select * from TT where UCID = '$UCID'"; 
		$output.= "<br>SQL select is: $s <br><br>";

	($t = mysqli_query($db, $s)) or die (mysqli_error($db));
	
	$output.="<table  border=2 >";
	$output.="<td>Type</td><td>amount</td><td>Date</td><td>Mail</td>";
	
	$count=0;
	while($r = mysqli_fetch_array ($t, MYSQLI_ASSOC))
	{
		$output.="<tr>";
		$UCID = $r["UCID"];
		$type = $r["type"];
		$amount = $r["amount"];
		$date = $r["date"];
		$mail = $r["mail"];
		
	   $output.= "<td>$type</td>";
	   $output.= "<td>$amount</td>";
	   $output.= "<td>$date</td>";
	   $output.= "<td>$mail</td>";
   
		//echo "<br>The UCID is $UCID";
		$output.="</tr>";
		$count += 1;
		if ($count >= $number){
			break;
		}
			
	};
	$output.="</table>";
}

?>