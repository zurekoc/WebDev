<?php
session_start() ;
$font='LaBelleAurore.ttf';
header('Content-Type: image/png');


$creds=$_GET["creds"];
$guess=$_GET["guess"];

$im   =imagecreatetruecolor(200,100); //creates a rectangle
$black= imagecolorallocate($im, -20,-20,40);
$black= imagecolorallocate($im, -40,-40,-40);

$greyish= imagecolorallocate($im, 200,200,200);
imagefilledrectangle($im, 6,6,250,100,$greyish); //throws a sub- rectangle that overlays in the original one

$_SESSION["captcha"]=$text;
//$_SESSION["captcha"]=$text1;
//$text1='Texting';
if($guess==$text) {
echo"got captcha<br>"; } 
else {
	echo"not captcha<br>"; } 
if($creds=="777") {
		echo"got creds<br>"; } 
else {
		echo"not creds<br>"; } 

$length=6;
$text = substr (str_shuffle (md5 (time ( ) )  ), 0, $length );
$text1 = substr (str_shuffle (md5 (time ( ) )  ), 0, $length );

imagettftext( $im, 20,-55,15,25, $black, $font, $text );
imagettftext( $im, 25,-20,8,15, $black, $font, $text1 );

imagepng($im);
imagedestroy($im);
?>