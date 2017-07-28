<?php
 $con = mysqli_connect("localhost","root","ajs141749","swp_project_db") or die(mysqli_connect_error());
 $name = $_REQUEST['b_fname'];
 $image = mysqli_query($con, "SELECT * FROM board WHERE b_fname='$name'");
 $image = mysqli_fetch_assoc($image);
 $image = $image['b_fdata'];
 echo $image;
 ?>
