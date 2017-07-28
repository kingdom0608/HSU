<?php
 $con=mysqli_connect("localhost","root","ajs141749","swp_project_db");

 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

 $result = mysqli_query($con,"SELECT * FROM users");
?>

<!DOCTYPE HTML>
<html>
<head>
<link href="./css/main.css" type="text/css" rel="stylesheet" />
<title>서버웹프로그래밍</title>
</head>

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

<body>
<h2 align='lef'>회원정보 안내</h2>

<div id="nav_menu" align='center'>
<ul>
<li><a href="./start.php" ><b>HOME</b></a></li>
<li><a href="./list.php" ><b>FREE BOARD</b></a></li>
<li><a class='active' href="./profile.php" ><b>MEMBERS LIST</b></a></li>
<li><?php
    echo "<a href='logout.php'><b>LOGOUT</b></a>";
?></li>

</ul>
</div>
</br>
<h1>회원 정보</h1>
<?php
 echo "<table border='1' align='center'>
 <tr>
 <th>ID</th>
 <th>NAME</th>
 <th>E-mail</th>
 </tr>";

 while($row = mysqli_fetch_array($result))
   {
   echo "<tr height='40px'>";
   echo "<td width='30px'>" . $row['id'] . "</td>";
   echo "<td width='100px'>" . $row['name'] . "</td>";
   echo "<td width='200px'>" . $row['email'] . "</td>";

   echo "</tr>";
   }
 echo "</table>";

 mysqli_close($con);
 ?>
</div>
</body>
</html>
