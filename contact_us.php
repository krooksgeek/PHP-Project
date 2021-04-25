<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
<style>
.error {color: #FF0000;}
.center {
  margin: auto;
  width: 65%;
  padding: 10px;
}
div.a {
  text-align: center;
}

div.c {
  background-color: whitesmoke;
  width: 800px;
  border: 20px solid #be556c;
  box-align:center;
  padding: 50px;
  margin: 20px;
  border-radius:30px;
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
  border: 2px solid #be556c;
}

.button2:hover {
  background-color: #be556c;
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
<?php
$nameErr = $emailErr = $phoneErr = "";
$name  = $email =  $phone = $msg = "";

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
  if (empty($_POST["email"])) {
    $emailErr = "email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if URL address syntax is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email value"; 
    }    
  }
  

  if (empty($_POST["phone"])) {
    $phoneErr = "phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    $res = array("options"=>array("regexp"=>"/^[0-9 ]{10}$/"));

    if (!filter_var($phone, FILTER_VALIDATE_REGEXP,$res)) {
      $phoneErr = "Invalid phone format";
    }
  } 
	$msg = test_input($_POST["msg"]);
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
$flag = 0;
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

  if($name != "" && $email != ""  && $phone != "" ){
    

      $sql="INSERT INTO contact_us(coid, name, email, mobile, message, timestamp) VALUES (NULL,'$name','$email','$phone','$msg',CURRENT_TIMESTAMP())";
      if (mysqli_query($conn, $sql)) {
        //echo '<script>alert("New record created successfully");</script>';
        //echo '"window.location.href=\'index.php\'"';
        echo '<script>
          alert("Your Response successfully Added");
        </script>';

      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        //echo '<script>alert("email is already exist");</script>';
      }
    
    
  } 
  mysqli_close($conn);
?> 

<div class = "a">
<h1>Contact Us</h1>
<br><br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<p class="error">*Required Fields</p>
    <font color="white">Name : </font><br>
    <input type="text" class="input1" name="name" placeholder="Enter The Name">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <font color="white">Email : </font><br>
    <input type="email" class="input1" name="email" placeholder="Enter The Email">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    <font color="white">Phone : </font><br>
    <input type="tel"  class="input1" id="phone" name="phone" placeholder="Enter The Mobile Number" >
    <span class="error">* <?php echo $phoneErr;?></span>
    <br><br>
    <font color="white">Message : </font><br>
	<textarea name="msg" cols="30" rows="7">
	</textarea><br><br>

    <input type="submit" class="button button1" name="register"  value="Send">
</form>
<br>
<button onclick="window.location.href='Home.php'" class="button button2">Back To Home</button>

</div>
<?php
  }
  else{
	  header("Location: wrong.php");
	  //include "wrong.php";
  }
  ?>
</body>
</html>