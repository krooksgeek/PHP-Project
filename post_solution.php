<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Solution</title>
<style>

.error {color: #FF0000;}
.center {
  margin: auto;
  width: 65%;
  padding: 10px;
}.navbar {
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
div.a {
  text-align: center;
}
div.b {
  text-align: left;
}
body{
    background: linear-gradient(#141e30, #243b55);
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
  if($_SESSION['ologin']==true){

?>
<body>
<div class="a">
<h1><b>Post Solution</b></h1>
<div class="navbar">
  <a href="officer_home.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">More 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      
      <a href="temp2.php">Sign Out</a>
    </div>
  </div> 
</div>
<br><br>

<?php

$status  = $reason =$soln = $img = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
if (empty($_GET["sts"])) {
  $nameErr = "Status is required";
} else {
  $status = $_GET["sts"];
  
}
  $cmd = $_GET["comid"];
  $reason = $_GET["rsn"];
  $soln = $_GET["sol"];
  $img = $_GET["filename1"];
}
?>
<?php
//$cmd = $_POST['comid'];

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

  if($status != ""){
    $sql="UPDATE `complaints` SET `status`='$status',`reason`='$reason',`solution`='$soln',`off_image`= '$img' WHERE cid = '$cmd'";
    if (mysqli_query($conn, $sql)) {
	  echo '<script>
        alert("Record Updated successfully");
      </script>';
      //echo "Record Updated successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } 
  
  mysqli_close($conn);
?> 


<div class="center">
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<br>
    
    <font color="white">Complaint ID :</font>
	<input type="text" name="comid" value= "<?php echo (isset($_POST['comid']))?$_POST['comid']:'';?>" readonly>
    <?php
    //echo $_POST['comid']; 
    ?><br><br>
	<font color="white">Status : </font>
	<select  name="sts">
    <option value="Pending" selected>Pending</option>
    <option value="On Progress">On Progress</option>
    <option value="Completed">Completed</option>
    <option value="Rejected">Rejected</option>
	</select>
	<br><br><br>
    <font color="white">Reason : </font>
    <input type="text" name="rsn" placeholder="write reason"><br><br><br>
    <font color="white">Solution:<br></font><br>
	<textarea name="sol" cols="30" rows="7">
	</textarea>
    <br><br>
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <font color="white"><input type="file" id="myFile" name="filename1"></font>
    <br><br>

    <input type="submit" class="button button1" name="postcomp"  value="Post Solution">
</form>

</div>
<br><br>
<button onclick="window.location.href='complaint_registry.php'" class="button button2">Back To Home</button>
<?php
  }
  else{
	  header("Location: wrong.php");
	  //include "wrong.php";
  }
  ?>
</div>
</html>