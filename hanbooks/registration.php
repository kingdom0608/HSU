<!DOCTYPE html>
<head>
		<meta charset="utf-8" />
		<title>서버웹프로그래밍</title>
		<link href="./css/main.css" type="text/css" rel="stylesheet" />
	</head>
 <?php

 session_start();

 $con = mysqli_connect('localhost','root','ajs141749','swp_project_db');

 if (isset($_POST['submit'])) {

     $username = $_POST['username'];
     $password = $_POST['password'];
     $email = $_POST['email'];

 if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
     echo "<script> alert('Please enter all required field!')</script>";
 } else {
     $query = "SELECT * FROM users WHERE name='$username' OR email='$email' ";
     $result = mysqli_query($con,$query);

     if ( mysqli_num_rows($result) > 0 ) {
         header("Location: registration.php?MSG=Username:$username or E-mail:$email is already exist, please use another one!");
     } else {
         $query = "INSERT INTO users (name, pass, email)
         VALUES ('$username','$password','$email')";
         if (mysqli_query($con,$query)) {
             $_SESSION['login']=$username;
             header("Location: start.php");
             }
     }
 }
 }

 ?>
 <html>
 <head>
     <title> Registration Page </title>
 </head>
 <body>
 <?php
 if(isset($_GET['MSG'])) {
 echo $_GET['MSG'];
 }
 ?>
 <center>
     <form method="post" action="registration.php"><br><br><br><br><br><br><br>
     <table border="2" >
         <tr>
             <td colspan="2" align="center"> <h1>회원가입<h1> </td>
         </tr>
         <tr>
             <td width="100" align="center"> UserName </td>
             <td> <input type="text" name="username" > </td>
         </tr>
         <tr>
             <td width="100" align="center"> Password </td>
             <td> <input type="password" name="password" > </td>
         </tr>
         <tr>
             <td width="100" align="center"> E-mail </td>
             <td> <input type="text" name="email" > </td>
         </tr>
         <tr>
             <td colspan="2" align="center">
             <input type="submit" name="submit" value="Sign-up" > </td>
         </tr>
         </table>
     </form>
     <b> 이미 회원가입 하셨다면?  <a href="index.php"> 로그인 </a> <b>
 </center>

 </body>
 </html>
