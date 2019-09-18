
<?php  
session_start();
include "config/datebase.php";
if(!isset($_SESSION['userid'])){
	echo "<script>
		alert('请先登录！');
		location.href='../login_regist/login.php';
		</script>";
}
//$_SESSION['userid']="000001";
$userid = $_SESSION['userid'];
$mysqli = new mysqli("localhost","root",$password,$parkName);
//判断连接是否成功
if($mysqli->connect_errno){
	die($mysqli->connect_error);
}
$mysqli->set_charset('utf-8');
$sql = "select role from user_edu_tea where et_id= '$userid'";
$result = $mysqli->query($sql);
$myrow = mysqli_fetch_assoc($result);
$role = $myrow['role'];
if($role == 0) echo "<a href='chooseStore.php' align='center'>管理课程</a>
	<a href='eduMessage.php' align='center'>机构信息</a>
	<a href='announcement.php'>发布公告</a>";
else
	echo "<a href='course.php'>课程信息管理</a>
<a href='applyTeacher.php'>试听申请列表</a>
<a href='teacherChange.php'>基本信息管理</a>
<a href='announcement.php'>发布公告</a>";

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>announcement</title>
</head>
<body>
<a href="/parent/php/videos.php">观看视频</a>
<a href="news.php">浏览新闻</a>
<a href='exit.php'>退出登录</a>
	<h2 align="center">已发布公告</h2>
	<table border="1" align="center">
		<tr>
			<td>题目</td>
			<td>发布时间</td>
			<td>内容</td>
		</tr>
<?php
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$mysqli->set_charset('utf-8');
	$sql = "select title,content,datetime from announcement order by datetime desc";
	$result = $mysqli->query($sql);
	while($myrow=mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>"; echo $myrow['title']; echo "</td>";
		echo "<td>"; echo $myrow['datetime']; echo "</td>";
		echo "<td width='500px'>"; echo $myrow['content']; echo "</td>";
		echo "</tr>";
	}
	$mysqli->close();
?>

	</table>
	<h2 align="center">发布新公告</h2>
	<table align="center" border="1">
		<form action="announcement.php" method="post" align="center" enctype="multipart/form-data">
		<tr>
			<td><input type="text" name="title" placeholder="title" required="required"></td>
		</tr>
		<tr>
			<td>
				<input type="text" name="content" placeholder="content" required="required">
			</td>
		</tr>
		<tr>
			<td>
				<input type="file" name="file" id="file">
				
			</td>
		</tr>
		<tr align="center">
			<td>
				<!-- <input type="submit" name="upload" value="upload"> -->
				<input type="submit" name="subann" value="提交">
			</td>
		</tr>
	
    </form>
	</table>
</body>

</html>
<?php
if(isset($_POST['subann'])){
	$_POST['subann']=false;
	$title =$_POST['title'];
	$content = $_POST['content'];
	if(!empty($_FILES['file']['tmp_name'])){
		if(file_exists('image/'.$_FILES['file']['name'])){
			echo $_FILES['file']['name']."already exist";
		}
		else{
			 move_uploaded_file($_FILES['file']['tmp_name'],'image/'.$_FILES['file']['name']);
			$content = $content.'<a href="/stephen/image/'.$_FILES['file']['name'].'">link</a>';
		}
	}
	$date = date('Y-m-d G:i:s',time());
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	$mysqli->set_charset('utf-8');
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$sql = "insert into announcement values('$userid','$title','$content','$date') ";
	if($mysqli->query($sql)){
		 echo "<script>
		 		alert('发布成功！');
		 		location.href='announcement.php';
		 		</script>";
	}
	else{
		echo $mysqli->error;
	}
	$mysqli->close();
}
?>
	