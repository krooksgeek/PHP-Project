<?php
session_start();
if($_SESSION['alogin'] == true){
	include 'admin_home.php';
}
else{
	echo "You are Not An Admin";
}
?>