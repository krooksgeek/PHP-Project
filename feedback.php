<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
<style>
.error {color: #FF0000;}
.center {
  margin: auto;
  width: 65%;
  padding: 10px;
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
div.b {
  text-align: left;
}
body{
    background: linear-gradient(#141e30, #243b55);
	font-family: "verdana";
}
input.input1{
    width: 40%;
    height: 5%;
	border: 1px;
    border-radius: 05ps;
    padding: 8px 15px 8px 15px;
	margin: 10px 0px 15px 0px;
    box-shadow: 1px 1px 2px 1px grey;
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
  font-family: "verdana";
}
  .button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #be556c;
  border-radius: 30px;
}

.button1:hover {
  background-color: #be556c;
  color: white;
}
.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #ff0000;
}

.button2:hover {
  background-color: #ff0000;
  color: white;
}
h1{
	color:white;
}

</style>
</head>
<?php
  session_start();
  if($_SESSION['login']==true){

?>
<body>
<div class="a">
<h1><b>Feedback</b></h1>
<div class="header" id="myHeader">
<div class="navbar">
  <a href="Home.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">More 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="contact_us.php">Contact Us</a>
      <a href="about_us.php">About Us</a>
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
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$nameErr  = "";
$name  =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $res = array("options"=>array("regexp"=>"/^[a-zA-Z-'-. ]*$/"));
    // check if name only contains letters and whitespace
    if (!filter_var($name, FILTER_VALIDATE_REGEXP,$res)) {
      $nameErr = "Invalid name format"; 
    }
  } 
  $feedback = test_input($_POST["feed"]);
}


?>
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

  if($name != "" ){
    $sql="INSERT INTO `feedback`(`fid`, `name`, `fdb`, `user_id`, `timestamp`) VALUES (NULL,'$name','$feedback','$uid',CURRENT_TIMESTAMP())";
    if (mysqli_query($conn, $sql)) {
      //echo "New record created successfully";
	  echo '<script>alert("Feedback Posted successfully");</script>';
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } 
  mysqli_close($conn);
?> 
<div class="center">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<p class="error">*Required Fields</p>
    <font color="white">Name:</font><br>
	<input type="text" class="input1" name="name" placeholder="Enter The Name">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <font color="white">Feedback:<br></font><br>
	<textarea name="feed" cols="30" rows="7">
	</textarea>
    <br><br>

    <input type="submit" class="button button1" name="postfeed"  value="Post Feddback">
</form>

</div>
<br><br>
<button onclick="window.location.href='Home.php'" class="button button2">Back To Home</button>
<?php
  }
  else{
	  header("Location: wrong.php");
	  //include "wrong.php";
  }
  ?>
<br><br><br>
</div>
</html>