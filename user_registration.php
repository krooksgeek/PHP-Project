<html>
<head>
<title> User Registration </title>
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
div.b {
  text-align: left;
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
  border: 2px solid black;
}

.button1:hover {
  background-color: black;
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
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
</head>
<body>
<div class="a">
<h1><b>User Registration</b></h1>
<hr>
<br><br>

<?php
$nameErr = $emailErr = $passErr = $phoneErr = $addErr = "";
$name  = $email = $pass = $phone = $add = "";

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
  if (empty($_POST["password"])) {
    $passErr = "password is required";
  } else {
    $pass = test_input($_POST["password"]);
	$pass = $_POST["password"];
    
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
  if (empty($_POST["address"])) {
    $addErr = "address is required";
  } else {
    $add = test_input($_POST["address"]);
    $res = array("options"=>array("regexp"=>"/^[A-Za-z0-9'\.\-\s\,]*$/"));
    
    if (!filter_var($add, FILTER_VALIDATE_REGEXP,$res)) {
      $addErr = "Invalid address format"; 
    }
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

  if($name != "" && $email != "" && $pass != "" && $phone != "" && $add != "" ){
    $sql1=mysqli_query($conn,"SELECT  `email`  FROM `user_register` ");
    if (mysqli_num_rows($sql1) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($sql1)) {

        if($row["email"]==$email){
          $flag = 1;
          break;
        }
        else {
          $flag = 0;
        }
      }
    }
    if($flag==0){
      $sql="INSERT INTO user_register(id, name, email, password, mobile, address, timestamp) VALUES (NULL,'$name','$email','$pass','$phone','$add',CURRENT_TIMESTAMP())";
      if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User Register successfully");</script>';
        //echo '"window.location.href=\'index.php\'"';
		//echo '<script>function alertFun(){
          //alert("New record created successfully");
        //}</script>';
		//echo '<script>"window.location.href=\'index.php\'"</script>';

      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    else{
       echo '<script>alert("Email Already Exist");</script>';
	   //echo '<script>function alertFun(){
          //alert("Email Already Exist");
        //}</script>';
		//echo '<script>"window.location.href=\'index.php\'"</script>';
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
<div class="center">
<div class="c">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<p class="error">*Required Fields</p>
    <input type="text" class="input1" name="name" placeholder="Enter The Name">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <input type="email" class="input1" name="email" placeholder="Enter The Email">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    <input type="password" class="input1" name="password" id="password" placeholder="Enter The Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" >
    <span class="error">* <?php echo $passErr;?></span>
    <br><br>
	<input type="checkbox" onclick="myFunction()">Show Password
	<br><br>
	<div id="message">
		<h3>Password must contain the following:</h3>
		<p id="letter" class="invalid">A lowercase letter</p>
		<p id="capital" class="invalid">A capital (uppercase) letter</p>
		<p id="number" class="invalid">A number</p>
		<p id="length" class="invalid">Minimum 8 characters</p>
	</div>
    <input type="tel"  class="input1" id="phone" name="phone" placeholder="Enter The Mobile Number" >
    <span class="error">* <?php echo $phoneErr;?></span>
    <br><br>
    <input type="text" class="input1" name="address" placeholder="Enter The Addresss">
    <span class="error">* <?php echo $addErr;?></span>
    <br><br>

    <input type="submit" class="button button1" name="register"  value="Register">
</form>

				
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

</div>
</div>
<br><br>
<pre>  <button onclick="window.location.href='index.php'" class="button button2">Back To Home</button></pre>
</div>
</html>