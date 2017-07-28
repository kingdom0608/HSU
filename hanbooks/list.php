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
	if(isset($_GET['page'])) {
		$page = $_GET['page'];

	} else {
		$page = 1;
	}
	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}
	$sql = 'select count(*) as cnt from board' . $searchSql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$allPost = $row['cnt'];
	if(empty($allPost)) {
		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
	} else {
		$onePage = 15;
		$allPage = ceil($allPost / $onePage);
		if($page < 1 && $page > $allPage) {
?>
			<script>
				alert("존재하지 않는 페이지입니다.");
				history.back();
			</script>
<?php
			exit;
		}

		$oneSection = 10;
		$currentSection = ceil($page / $oneSection);
		$allSection = ceil($allPage / $oneSection);

		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);

		if($currentSection == $allSection) {
			$lastPage = $allPage;
		} else {
			$lastPage = $currentSection * $oneSection;
		}
		$prevPage = (($currentSection - 1) * $oneSection);
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1);
		$paging = '<ul>';
		if($page != 1) {
			$paging .= '<li class="page page_start"><a href="./list.php?page=1' . $subString . '"><<</a></li>';
		}
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./list.php?page=' . $prevPage . $subString . '"><</a></li>';
		}
		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="page current">' . $i . '</li>';
			} else {
				$paging .= '<li class="page"><a href="./list.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./list.php?page=' . $nextPage . $subString . '">></a></li>';
		}
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./list.php?page=' . $allPage . $subString . '">>></a></li>';
		}
		$paging .= '</ul>';
		$currentLimit = ($onePage * $page) - $onePage;
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;

		$sql = 'select * from board' . $searchSql . ' order by b_no desc' . $sqlLimit;
		$result = $db->query($sql);
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
<h2 align='center'>AHNJAESUNG 게시판</h2>
<div id="nav_menu">
<ul>
<li><a href="./start.php" ><b>HOME</b></a></li>
<li><a class='active' href="./list.php" ><b>FREE BOARD</b></a></li>
<li><a href="./profile.php" ><b>MEMBERS LIST</b></a></li>
<li><?php
    echo "<a href='logout.php'><b>LOGOUT</b></a>";
?></li>
<ul style="float:right;list-style-type:none;">
<li><a href="./write.php" class="btnWrite btn"><b>WRITING BOARD</b></a></li>
</ul>
</ul>
</div>
</br>
	<article class="boardArticle">
		<h2>FREE BOARD</h2>
		<div id="boardList">
			<table border='1' align='center'>
				<thead>
					<tr>
						<th scope="col" class="no" width='60px'>번호</th>
						<th scope="col" class="title" width='400px'>제목</th>
						<th scope="col" class="author" width='100px'>작성자</th>
						<th scope="col" class="date" width='100px'>작성일</th>
						<th scope="col" class="hit" width='60px'>조회</th>
						<th scope="col" class="author" width='60px'>첨부파일</th>
					</tr>
				</thead>
				<tbody align='center'>
						<?php
						$i=0;
						if(isset($emptyData)) {
							echo $emptyData;
						} else {
							while($row = $result->fetch_assoc())
							{
								$datetime = explode(' ', $row['b_date']);
								$date = $datetime[0];
								$time = $datetime[1];
								if($date == Date('Y-m-d'))
									$row['b_date'] = $time;
								else
									$row['b_date'] = $date;
						?>
						<tr>
							<td class="no" align='center'><?php echo $row['b_no']?></td>
							<td class="title" align='center'>
								<a href="./listview.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a>
							</td>
							<td class="author" align='center'><?php echo $row['b_id']?></td>
							<td class="date" align='center'><?php echo $row['b_date']?></td>
							<td class="hit" align='center'><?php echo $row['b_hit']?></td>
							<td class="author" align='center'><?php echo $row['b_fname']?></td>
						</tr>

						<?php
							}
						}
						?>
				</tbody>
			</table>
			<div class="paging">
				<?php echo $paging ?>
			</div>
			<div class="searchBox">
				<form action="./list.php" method="get">
					<select name="searchColumn">
						<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
						<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
						<option <?php echo $searchColumn=='b_id'?'selected="selected"':null?> value="b_id">작성자</option>
						<option <?php echo $searchColumn=='b_date'?'selected="selected"':null?> value="b_date">날짜</option>
					</select>
					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
					<button type="submit">검색</button>
				</form>
			</div>
		</div>
	</article>
</body>
</html>
