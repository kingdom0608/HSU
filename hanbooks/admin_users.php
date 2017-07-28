<!DOCTYPE>
<html>
<head>
<link href="./css/main.css" type="text/css" rel="stylesheet" />
<title>서버웹프로그래밍</title>
</head>
<body>
<br><br>
<h1>회원 목록</h1>
<br><br>
<?php
 $con=mysqli_connect("localhost","root","ajs141749","swp_project_db");

 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

 $result = mysqli_query($con,"SELECT * FROM users");
?>

<form action="./admin_delete.php" method="post">
<?php
 echo "<table border='1'>
 <tr>
 <th>ID</th>
 <th>NAME</th>
 <th>PASS</th>
 <th>E-mail</th>
 <th>DELETE</th>
 </tr>";

 while($row = mysqli_fetch_array($result))
   {
   echo "<tr>";
   echo "<td>" . $row['id'] . "</td>";
   echo "<td>" . $row['name'] . "</td>";
   echo "<td>" . $row['pass'] . "</td>";
   echo "<td>" . $row['email'] . "</td>";
    echo "<td align='center'>"  ?><button name='id' value='<?php echo $row['id']?>'>delete</button> <?php "</td>";
   echo "</tr>";
   }
 echo "</table>";

 mysqli_close($con);
 ?>
 </form>
 </body>
 </html>
