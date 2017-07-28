<?php
session_start();
	require_once("./dbconnect.php");
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}
	if(empty($bNo)) {
		$bID = $_POST['bID'];
		$date = date('Y-m-d H:i:s');
	}

	$bPassword = $_POST['bPassword'];
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];

	 $con = mysqli_connect("localhost","root","ajs141749","swp_project_db") or die(mysqli_connect_error());

	  $file = $_FILES['image']['tmp_name'];


         $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
         $image_name = addslashes($_FILES['image']['name']);
         $image_size = getimagesize($_FILES['image']['tmp_name']);
         $_SESSION['fname']=$image_name;

             $sql = "INSERT INTO board(b_fname, b_fdata) VALUES('$image_name','$image_data')" ;


if(isset($bNo)) {

	$sql = 'select count(b_password) as cnt from board where b_password=password("' . $bPassword . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	if($row['cnt']) {
		$sql = 'update board set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = ' . $bNo;
		$msgState = '수정';

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


} else {
	$sql = 'insert into board (b_no, b_title, b_content, b_date, b_hit, b_id, b_password,b_fname, b_fdata) values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", password("' . $bPassword . '"),"'.$image_name.'","'.$image_data.'")';
	$msgState = '등록';
}

if(empty($msg)) {
	$result = $db->query($sql);

	if($result) {
		$msg = '게시물이 ' . $msgState . '되었습니다.';
		if(empty($bNo)) {
			$bNo = $db->insert_id;
		}
		$replaceURL = './listview.php?bno=' . $bNo;
	} else {
		$msg = '게시물을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}
}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
