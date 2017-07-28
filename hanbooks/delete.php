<?php
	require_once("./dbconnect.php");
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
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
    background-color:#2E9AFE;
}
</style>

<body>
<h2>자유 게시판</h2>
<div id="nav_menu">
<ul>
<li><a href="./start.php" ><b>홈으로</b></a></li>
<li><a class='active' href="./list.php" ><b>자유 게시판으로</b></a></li>
<li><a href="./profile.php" ><b>회원 정보 보기</b></a></li>
<li><?php
    echo "<a href='logout.php'><b>로그아웃</b></a>";
?></li>
 <ul style="float:right;list-style-type:none;">
<li><a href="./write.php?bno=<?php echo $bNo?>"><b>수정하기</b></a></li>
				<li><a href="./delete.php?bno=<?php echo $bNo?>"><b>삭제하기</b></a></li>
				<li><a href="./list.php"><b>목록으로</b></a></li>

</ul>
</ul>
</div>
	<article class="boardArticle">
		<h3>게시물 삭제하기</h3><br><br><br>
		<p>비밀번호를 입력해야 삭제할 수 있습니다!</p>
		<?php
			if(isset($bNo)) {
				$sql = 'select count(b_no) as cnt from board where b_no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(empty($row['cnt'])) {
		?>
		<script>
			alert('글이 존재하지 않습니다.');
			history.back();
		</script>
		<?php
			exit;
				}

				$sql = 'select b_title from board where b_no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
		?>

			<form action="./delete_sql.php" method="post">
				<input type="hidden" name="bno" value="<?php echo $bNo?>">
					<label for="bPassword">비밀번호 </label>
					<input type="password" name="bPassword" id="bPassword">
					<button type="submit" class="btnSubmit btn">삭제</button>
			</form>

	<?php
		} else {
	?>
		<script>
			alert('정상적인 경로를 이용해주세요.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>
	</article>
</body>
</html>
