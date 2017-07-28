<?php

	require_once("./dbconnect.php");
	$bNo = $_GET['bno'];

	if(!empty($bNo) && empty($_COOKIE['board_free_' . $bNo])) {
		$sql = 'update board set b_hit = b_hit + 1 where b_no = ' . $bNo;
		$result = $db->query($sql);
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php
		} else {
			setcookie('board_free_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
		}
	}

	$sql = 'select b_title, b_content, b_date, b_hit, b_id, b_fname, b_fdata from board where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$file = $_FILES['image']['tmp_name'];
	$image_name = addslashes($_FILES['image']['name']);


	 session_start();
 if (!isset($_SESSION['login'])) {
         header("Location: loginstart.php");
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
<html>
<head>
	<meta charset="utf-8" />
	<title>서버웹프로그래밍</title>
	<link rel="stylesheet" href="./css/main.css" />
	<link rel="stylesheet" href="./css/board.css" />
	<script src="./js/jquery-2.1.3.min.js"></script>
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

.active2 {
    background-color:#2E9AFE;
}



</style>

<body>
<h2>자유 게시판</h2>
<div id="nav_menu">
<ul>
<li><a href="./start.php" ><b>HOME</b></a></li>
<li><a class='active2' href="./list.php" ><b>FREE BOARD</b></a></li>
<li><a href="./profile.php" ><b>MEMBERS LIST</b></a></li>
<li><?php
    echo "<a href='logout.php'><b>LOGOUT</b></a>";
?></li>

 <ul style="float:right;list-style-type:none;">
<li><a href="./write.php?bno=<?php echo $bNo?>"><b>수정하기</b></a></li>
				<li><a href="./delete.php?bno=<?php echo $bNo?>"><b>삭제하기</b></a></li>
				<li><a href="./list.php"><b>목록으로</b></a></li>

</ul>
</ul>
</div>
	<article class="boardArticle">
		<h3>자유게시판 글쓰기</h3>
		<div id="boardView">
			<h3 id="boardTitle">제목 : <?php echo $row['b_title']?></h3>
			<div id="boardInfo">
				<span id="boardID">작성자 : <?php echo $row['b_id']?></span><br>
				<span id="boardDate">작성일 : <?php echo $row['b_date']?></span><br>
				<span id="boardHit">조회수 : <?php echo $row['b_hit']?></span><br><br>
				<span>내용 :</span>
			</div>

			<div id="boardContent"><br><?php echo $row['b_content']."<br><br>";
												if(!empty($row['b_fname'])){
												echo "<img width=40% height=40% src='get.php?b_fname=$row[b_fname]'>";
												}?></div>

		<div id="boardComment">
			<?php require_once('./comment.php')?>
		</div>
		</div>
	</article>
</body>
</html>
