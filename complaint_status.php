<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complaint status</title>
<style>
*{
	font-family: verdana;
}
.center {
  margin: auto;
  width: 65%;
  padding: 10px;
}
.center1
{
  margin: auto;
  width: 50%;
  padding: 10px;
  margin-left: 450px;
}
.navbar {
  overflow: hidden;
  background-color: #be556c;
   border-radius:30px;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: right;
  overflow: hidden;
  padding: 0px 35px 0px 0px;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 40px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
.top-container {
  background-color: #f1f1f1;
  padding: 30px;
  text-align: center;
}

.header {
  padding: 0px 0px;
  color: #f1f1f1;
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 102px;
}
div.a {
  text-align: center;
}

body{
    background: linear-gradient(#141e30, #243b55);
}

input:focus {
  background-color: lightblue;
}
  .button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
  .button1 {
  background-color: white; 
  color: black; 
  border: 2px solid red;
}

.button1:hover {
  background-color: red;
  color: white;
}

h1{
	color:white;
}
table {
  font-family: vardana;
  border-collapse: collapse;
}
td {
  text-align: left;
  padding: 8px;
}
td:nth-child(odd) {
text-align: right;
}
</style>
</head>
<?php
  session_start();
  if($_SESSION['login']==true){

?>
<body>
<div class="a">
<h1><b>Complaint Status</b></h1>
<div class="header" id="myHeader">
<div class="navbar">
  <a href="Home.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">More 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="contact_us.php">Contact Us</a>
      <a href="contact_us.php">About Us</a>
      <a href="temp2.php">sign out</a>
    </div>
  </div> 
</div>
</div>
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
<br><br>

<?php

//session_start();
$uid = $_SESSION['id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complaint_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";

    
  $sql = "SELECT * FROM `complaints` WHERE user_id = '$uid'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		
		echo "<br>
		<table class="."center1".">
		<tr>
		    <th></th>
			<tm></th>
		</tr>";
      echo "<tr><td><b><font color='cyan'>Complaint ID : </font></b></td>" . "<td><b><font color='white'>".$row["cid"]."</font></b></td></tr><br>". "<tr><td><b><font color='cyan'>Name : </font></b></td>" ."<b><td><b><font color='white'>" .$row["name"]. " </font></b></td></tr><br>" ."<tr><td><b><font color='cyan'>Landmark : </font></b></td>". "<td><b><font color='white'>".$row["landmark"]. "</font></b></td></tr><br>"."<tr><td><b><font color='cyan'>Address : </font></b></td>"."<b><td><b><font color='white'>".$row["address"]. "</font></b></td></tr><br>" ."<tr><td><b><font color='cyan'>Location : </font></b></td>"."<td><b><font color='white'>".$row["location"]. "</font></b></td></tr><br>" ."<tr><td><b><font color='cyan'>Complaint Type : </font></b></td>"."<td><b><font color='white'>".$row["ctype"]. "</font></b></td></tr><br>" ."<tr><td><b><font color='cyan'>Complaint : </font></b></td>"."<b><td><b><font color='white'>".$row["comp"]. "</font></b></td></tr></b><br>" ;
      echo "</table>";
	  if($row["status"]=="Pending"){
        echo "<b><font color='red'>Status : ".$row["status"]."<br></font></b>";
      }
      if($row["status"]=="Completed"){
        echo "<b><font color='#00C000'>Status : ".$row["status"]."<br></font></b>";
      }
      if($row["status"]=="On Progress"){
        echo "<b><font color='orange'>Status : ".$row["status"]."<br></font></b>";
      }
      if($row["status"]=="Rejected"){
        echo "<b><font color='red'>Status : ".$row["status"]."<br></font></b>";
      }
	  echo "<b><font color='cyan'>proof : <br></font></b>";
	  echo '<img  src="'.$row['user_image'].'" width=500 height=300>';
	  echo ""."<br>";
	  if($row["status"]=="Completed"){
		  echo "<b><font color='cyan'>Officer proof : <br></font></b>";
		  echo '<img  src="'.$row['off_image'].'" width=500 height=300>';
		  echo "<br>";
		  echo "<b><font color='#00C000'>Reason : </font></b>"."<b><font color='white'>".$row["reason"]."<br></font></b>";
		  echo "<b><font color='#00C000'>Solution : </font></b>"."<b><font color='white'>".$row["solution"]."<br></font></b>";
	  }
	  //echo '<img  src="'.$row['off_image'].'" width=500 height=300>';
    }
  } else {
    echo "0 results";
  }
  

  
  mysqli_close($conn);
?> 



<br><br>
<button onclick="window.location.href='Home.php'" class="button button1">Back To Home</button>
<?php
  }
  else{
	  //include "wrong.php";
	  header("Location : wrong.php");
  }
  ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
</html>