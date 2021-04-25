<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<style>

div.zoom {
  padding: 10px;
  transition: transform .2s;
  width: 20px;
  height: 35px;
  margin: 0 auto;
}
.zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
img.i1 {
  border: 0px solid #ddd;
  border-radius: 250%;
  padding: 5px;
  width: 500px;
}
body {
  background: linear-gradient(#141e30, #243b55);
  font-family:
}
table, th, td {
  border: 0px;
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
  width: 200px;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
}

.button3 {
  background-color: white; 
  color: black; 
  border: 2px solid #ff0080;
}

.button3:hover {
  background-color: #ff0080;
  color: white;
}

.button4 {
  background-color: white; 
  color: black; 
  border: 2px solid #ff0000;
}

.button4:hover {
  background-color: #ff0000;
  color: white;
}
div.a {
  text-align: center;
}
h1 {
  color: white;
}
</style>

<div class="a">
<h1>Online Complaint Registration and Management system</h1>
<hr>
<br><br><br><br><br>
<table>
  <tr>
	<th></th>
	<th></th>
  <tr>
	<td rowspan="5"><pre>                                     <img class="i1" src="complain.jpg"><pre></td>
  </tr>
  <tr>
    <td><pre>                 <div class="zoom"><button onclick="window.location.href='officer_login.php'" class="button button1">Officer Login</button></div></pre></td>
  </tr>
  <tr>
	<td><pre>                 <div class="zoom"><button onclick="window.location.href='admin_login.php'" class="button button2">Admin Login</button></div></pre></td>
  </tr>
  <tr>
    <td><pre>                 <div class="zoom"><button onclick="window.location.href='user_login.php'" class="button button3">User Login</button></div></pre></td>
  </tr>
  <tr>
	<td><pre>                 <div class="zoom"><button onclick="window.location.href='user_registration.php'" class="button button4">User Registration</button></div></pre></td>
  </tr>
  
</table>


<br><br><br><br><br><br><br>


</div>
</body>
</html>