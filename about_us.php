<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}
div.a {
  text-align: center;
}
.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
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

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
</head>
<body>
<?php
  session_start();
  if($_SESSION['login']==true){

?>
<div class="about-section">
  <h1>About Us</h1>
  <p>Institute Of Technology Nirma University</p>
</div>

<h2 style="text-align:center">Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <div class="container">
        <h2>Tirthraj</h2>
        <p class="title">Student</p>
        <p>Roll No. : 18BCE034</p>
        <p>18bce034@nirmauni.ac.in</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <div class="container">
        <h2>Naynesh Chaudhary</h2>
        <p class="title">Student</p>
        <p>Roll No. : 18BCE036</p>
        <p>18bce036@nirmauni.ac.in</p>
      </div>
    </div>
  </div>
<br><br><br>
<div class="a">
<button onclick="window.location.href='Home.php'" class="button button1">Back To Home</button>
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
