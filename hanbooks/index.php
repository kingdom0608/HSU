 <?php
 session_start();
 $con = mysqli_connect('localhost','root','ajs141749','swp_project_db');
 if (isset($_POST['submit'])) {
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
             header("Location: start.php");
     } else {
         echo "Wrong username or password !";
     }
 }
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>서버웹프로그래밍</title>
		<link href="./css/main.css" type="text/css" rel="stylesheet" />
		<style>
		#center h1{
			text-align=center;
		}
		</style>
	</head>
	<body>
		<br><br><br><br><br><br><br>
			<h1 id='center'>
				AHNJAESUNG`s PRIVATE PAGE
			</h1>
 <center>
     <form method="post" action="index.php">
     <table border="2"  width='2px'>
         <tr>
             <td colspan="2" align="center" > Login </td>
         </tr>
         <tr>
             <td width="100" align="center"> ID </td>
             <td> <input type="text" name="username" > </td>
         </tr>
         <tr>
             <td width="100" align="center"> Password </td>
             <td> <input type="password" name="password" > </td>
         </tr>
         <tr>
             <td colspan="2" align="center">
             <input type="submit" name="submit" value="로그인" >
				 </td>
         </tr>
         </table>
     </form>
     <b><a href="registration.php"> 회원가입 </a></b>
	 <br><br>
	 <a href="admin.php">관리자 페이지</a>
 </center>
 </body>
</html>
