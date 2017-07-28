<?php
 session_start();
 if (!isset($_SESSION['login'])) {
         header("Location: index.php");
     }

 $con = mysqli_connect('localhost','root','ajs141749','swp_project_db');

 if (isset($_POST['profile'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];

     if (empty($_POST['username'])) {
         echo "<script> alert('Please enter your name!')</script>";
         }
     if (empty($_POST['password'])) {
         echo "<script> alert('Please enter your password!')</script>";
         }

     $query = "SELECT name, pass FROM users WHERE name='$username' AND pass='$password' ";
     $result = mysqli_query($con,$query);

     if ( mysqli_num_rows($result) > 0 ) {
             $_SESSION['login']=$username;
             header("Location: profile.php");
     } else {
         echo "Wrong username or password !";
     }
 }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>서버웹프로그래밍</title>

	<link href="./css/main.css" type="text/css" rel="stylesheet" />
</head>


<h2> Welcome <?=$_SESSION['login']?> </h2>
<style>
#nav_menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #2E9AFE;
}

#nav_menu li {
    float: left;
}

#nav_menu li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.active {
    background-color: #2E9AFE;
}
</style>


<body id="css-zen-garden">
<h2 align='center'>AHNJAESUNG's 게시판</h2>

<div id="nav_menu">
<ul>
<li><a class='active' href="./start.php" ><b>HOME</b></a></li>
<li><a href="./list.php" ><b>FREE BOARD</b></a></li>
<li><a href="./profile.php" ><b>MEMBERS LIST</b></a></li>
<li><?php
    echo "<a href='logout.php'><b>LOGOUT</b></a>";
?></li>

</ul>
</div>

</br></br>

<img src="./img/MacBook.jpg" width="600" height="450">
</body>
</html>
