<!DOCTYPE html>
<html>
<body>
<style>
.error {color: #FF0000;}
body{
    /*background-color:#003366;*/
	background: linear-gradient(#141e30, #243b55);
}
.center {
  margin: auto;
  width: 45%;
  padding: 10px;
}
div.a {
  text-align: center;
}
div.b {
  background-color: whitesmoke;
  width: 500px;
  border: 20px solid #be556c;
  box-align:center;
  padding: 50px;
  margin: 20px;
  border-radius:30px;
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
  border: 2px solid black;
}

.button1:hover {
  background-color: black;
  color: white;
}
.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #ff0080;
}

.button2:hover {
  background-color: #ff0080;
  color: white;
}
h1{
    color:white;
}
</style>

<?php
$passErr = $emailErr = "";
$email = $pass  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["email"])) {
    $emailErr = "email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email value"; 
    }    
  }
  if (empty($_POST["password"])) {
    $passErr = "password is required";
  } 
  else {
    $pass = $_POST["password"];
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
session_start();
$_SESSION['alogin'] = false;
$servername = "localhost";
$username = "root";
$password1 = "";
$dbname = "complaint_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password1, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";

  if($email != "" && $pass != "" ){
    $sql1=mysqli_query($conn,"SELECT email,password FROM admin WHERE email='$email'");
    //$sql2=mysqli_query($conn,"SELECT password FROM admin WHERE password='$pass'");
    $sql11 = '';
    $sql22 = '';
	while ($row = $sql1->fetch_assoc()) {
		$sql11 = $row['email'];
    $sql22 = $row['password'];
	}
	//echo "<br>";
	// echo gettype($sql11)."<br>";
	// echo gettype($sql22)."<br>";
	// echo gettype($email)."<br>";
	// echo gettype($pass)."<br>";
	//$sql11 = str_replace("<br>", "", $sql11);
	//$sql22 = str_replace("<br>", "", $sql22);
	// echo "$sql11"."<br>";
	// echo "$sql22"."<br>";
	// echo $email."<br>";
	// echo $pass."<br>";
	
	

    if($email == $sql11 && $pass == $sql22){
      $_SESSION['alogin'] = true; 
	  
      header("Location: admin_home.php");
      //echo "Login successfully";

    }
    else{
      $_SESSION['alogin'] = false;
      echo '<script>
      alert("Incorrect email or password");
    </script>';
    }
  } 
  mysqli_close($conn);
?> 
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


</script>
<div class="a">
<h1>Admin Login</h1>
<hr>
<br><br><br>
<div class="center">
<div class="b">
<img src="admin1.jpg" width="400" height="250"><br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    &nbsp &nbsp Email :
    <input type="email" class="input1" name="email" placeholder="Enter The Email">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Password: 
    <input type="password" class="input1" id="password" name="password" placeholder="Enter The Password">
    <span class="error">* <?php echo $passErr;?></span><br>
    <input type="checkbox" onclick="myFunction()">Show Password
    <br><br>

    <input type="submit" class="button button1" name="login"  value="login">
</form>
</div>
</body>
<br><br>
<button onclick="window.location.href='index.php'" class="button button2">Back To Home</button>
</div>
</div>
</html>