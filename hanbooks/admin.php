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

     $query = "SELECT name, pass FROM admin WHERE name='$username' AND pass='$password' ";
     $result = mysqli_query($con,$query);

     if ( mysqli_num_rows($result) > 0 ) {
             $_SESSION['login']=$username;
             header("Location: admin_users.php");
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
    <script>
      function showHint(str)
      {
      if (str.length==0)
        {
        document.getElementById("txtHint").innerHTML="";
        return;
        }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
          document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
          }
        }
      xmlhttp.open("GET","gethint.php?q="+str,true);
      xmlhttp.send();
      }
</script>
	</head>
	<body>
		<div class="headfoot"><br><br><br><br><br><br><br>

		</div>
<h1>관리자 페이지</h1>

 <center>
     <form method="post" action="admin.php">
     <table border="2" >
         <tr>
             <td colspan="2" align="center">Admin Login</td>
         </tr>
         <tr>
             <td width="100" align="center"> ID </td>
             <td> <input type="text" name="username" onkeyup="showHint(this.value)"></td>
             <p>Suggestions: <span id="txtHint"></span></p>
         </tr>
         <tr>
             <td width="100" align="center"> Password </td>
             <td> <input type="password" name="password" > </td>
         </tr>
         <tr>
             <td colspan="2" align="center">
             <input type="submit" name="submit" value="로그인" > </td>
         </tr>
         </table>
     </form>
     <a href="index.php">로그인 페이지로</a>
 </center>
 </body>
</html>
			</p>
