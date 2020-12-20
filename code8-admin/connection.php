<?php
error_reporting(0);
$con=mysqli_connect("localhost","root","","code8");
if(!$con)
{
	die("Connection Unsuccessful ".mysqli_connect_error());
}
mysqli_set_charset($con,"utf8");
?>