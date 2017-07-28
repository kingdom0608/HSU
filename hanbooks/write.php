<?php
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



	require_once("./dbconnect.php");


	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}

	if(isset($bNo)) {
		$sql = 'select b_title, b_content, b_id from board where b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
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
    background-color: #2E9AFE;
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
<li><a href="./list.php" class="btnList btn"><b>목록으로 돌아가기</b></a></li>
</ul>
</ul>
</div>
	<article class="boardArticle">
		<h3 align='center'>글쓰기</h3>
		<div id="boardWrite">
			<form action="./write_sql.php" method="post" enctype="multipart/form-data">
				<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				?>
				<table id="boardWrite" border='1'>

					<tbody>
						<tr>
							<th scope="row"><label for="bID" >아이디</label></th>
							<td class="id">
								<?php
								if(isset($bNo)) {
									echo $row['b_id'];
								} else { ?>
									<input type="hidden" name="bID" id="bID" value="<?=$_SESSION['login']?>"><?php echo $_SESSION['login'];?>
								<?php } ?>
							</td
						</tr>
						<tr>
							<th scope="row"><label for="bPassword">비밀번호</label></th>
							<td class="password"><input type="password" name="bPassword" id="bPassword"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bTitle">제목</label></th>
							<td class="title"><input type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:"제목없음"?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bTitle">파일첨부</label></th>
							<td class="title">
							<form action="./write_sql.php" method="post" enctype="multipart/form-data">File :
								<input type="file" name="image">
								</td>
								</form>
						</tr>
						<tr>
							<th scope="row"><label for="bContent">내용</label></th>
							<td class="content"><textarea name="bContent" id="bContent"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">
						<?php echo isset($bNo)?'수정하기':'작성하기'?>
					</button>

				</div>
			</form>
		</div>
	</article>
</body>
</html>
