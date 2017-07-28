<?php
	$sql = 'select * from comment where co_no=co_order and b_no=' . $bNo;
	$result = $db->query($sql);
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
<div id="commentView">
	<form action="comment_sql.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bNo?>">
		<?php
			while($row = $result->fetch_assoc()) {
		?>
		<ul class="oneDepth">
			<li>
				<div id="co_<?php echo $row['co_no']?>" class="commentSet">
					<div class="commentInfo">
						<div class="commentId">작성자: <span class="coId"><?php echo $row['co_id']?></span></div>
						<div class="commentBtn">


							<a href="#" class="comt write">[댓글/</a>
							<a href="#" class="comt modify">수정/</a>
							<a href="#" class="comt delete">삭제]</a>
						</div>
					</div>
					<br>
					<div class="commentContent" align='left'><b>-></b> <?php echo $row['co_content']?></div>
					<br>
				</div>
				<?php
					$sql2 = 'select * from comment where co_no!=co_order and co_order=' . $row['co_no'];
					$result2 = $db->query($sql2);
					while($row2 = $result2->fetch_assoc()) {
				?>
				<ul class="twoDepth">
					<li>
						<div id="co_<?php echo $row2['co_no']?>" class="commentSet">
							<div class="commentInfo">
								<div class="commentId">작성자:  <span class="coId"><?php echo $row2['co_id']?></span></div>
								<div class="commentBtn">
									<a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a>
								</div>
							</div>
							<div class="commentContent"><?php echo $row2['co_content'] ?></div>
						</div>
					</li>
				</ul>
				<?php
					}
				?>
			</li>
		</ul>
		<?php } ?>
	</form>
</div>
<form action="comment_sql.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bNo?>">
	<table border='1'>
		<tbody>
			<tr>
				<th scope="row"><label for="coId">아이디</label></th>
				<td><input type="hidden" name="coId" id="coId" value='<?=$_SESSION['login']?>'><?php echo $_SESSION['login'];?></td>
			</tr>
			<tr>
				<th scope="row">
			<label for="coPassword">비밀번호</label></th>
				<td><input type="password" name="coPassword" id="coPassword"></td>
			</tr>
			<tr>
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent"></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="submit" value="댓글 달기">
	</div>
</form>
