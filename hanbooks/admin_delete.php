<?php
 $con=mysqli_connect("localhost","root","ajs141749","swp_project_db");
 // Check connection
 $id = $_POST['id'];

 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }else{
	   mysqli_query($con,"DELETE FROM users WHERE id=$id");
	    header("Location: admin_users.php");
   }



 mysqli_close($con);
 ?>
