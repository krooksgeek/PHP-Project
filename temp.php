<?php
session_start();
if($_SESSION['login'] == true){
	include 'Home.php';
}
else{
	echo "Not logged in";
}
?>