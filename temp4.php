<?php
session_start();
if($_SESSION['ologin'] == true){
	include 'officer_home.php';
}
else{
	echo "You are Not An Officer";
}
?>