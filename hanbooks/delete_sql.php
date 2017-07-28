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
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}
	$bPassword = $_POST['bPassword'];

if(isset($bNo)) {

	$sql = 'select count(b_password) as cnt from board where b_password=password("' . $bPassword . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();


	if($row['cnt'] || $_SESSION['login']=='admin') {
		$sql = 'delete from board where b_no = ' . $bNo;

	} else {
		$msg = '비밀번호가 맞지 않습니다.';
	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php
		exit;
	}
}

	$result = $db->query($sql);


if($result) {
	$msg = '글이 삭제되었습니다.';
	$replaceURL = './list.php';
} else {
	$msg = '글을 삭제하지 못했습니다.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
