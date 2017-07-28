<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>

  <?php
    $con = mysqli_connect('localhost','root','hansung','itshansung');
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    ?> <span style = 'font-size:3.5em; color:white;'> <?php echo "Zigzag Running";?></span> <?php
    echo "<hr>";
    echo "<br>";
    $result = mysqli_query($con,"SELECT id,name,birthday,starthour,startmin,startsec,endhour,endmin,endsec,duration FROM user ORDER BY id DESC LIMIT 1");

    while($row = mysqli_fetch_array($result))
      {
      ?> <span style = 'font-size:2.5em; color:white;'> <?php echo "성&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp명 : "." ".$row['name']."";?></span> 
	  <?php
      echo "<br>";
      ?> <span style = 'font-size:2.5em; color:white;'> <?php echo "생년월일 : "." ".$row['birthday']."";?></span> 
	  <?php
	  echo "<br>";
      echo "<br>";
	  ?> <span style = 'font-size:3em; color:white;'> <?php echo "시작시간";?></span> 
	  <?php	  echo "<br>";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['starthour']."시";?></span>
	  <?php
	  echo "&nbsp";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['startmin']."분";?></span>
	  <?php
	  echo "&nbsp";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['startsec']."초";?></span>
	  <?php
	  echo "<br>";
      echo "<br>";
	  ?> <span style = 'font-size:3em; color:white;'> <?php echo "종료시간";?></span> 
	  <?php	  echo "<br>";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['endhour']."시";?></span>
	  <?php
	  echo "&nbsp";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['endmin']."분";?></span>
	  <?php
	  echo "&nbsp";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['endsec']."초";?></span>
	  <?php
	  echo "<br>";
      echo "<br>";
      ?> <span style = 'font-size:3em; color:white;'> <?php echo "경과시간";?></span> 
	  <?php	  echo "<br>";
	  ?> <span style = 'font-size:2.5em; color:white;'> <?php echo $row['duration']."초";?></span>
	  <?php
      }
    echo "<br>";
    $A = $row['duration'];
    mysqli_close($con);
  ?>
    <title>졸업 프로젝트</title>
    <link href="cssfile.css" media="screen and (min-width: 512px) and (max-width: 1024px)" rel="stylesheet">
    <style type="text/css" media="screen and (min-width: 512px) and (max-width:1024px)">
    /* style */
    </style>

    <style>
      @import url(cssfile.css) screen and (min-width: 152px) and (max-width: 1024px);
    </style>

    <style>
      body {background-color:#00BFFF};

    </style>
</head>
<body>
</body>
</html>