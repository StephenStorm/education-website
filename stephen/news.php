
<?php  
session_start();
include "config/datebase.php";
if(!isset($_SESSION['userid'])){
	echo "<script>
		alert('请先登录！');
		location.href='../login_regist/login.php';
		</script>";
}
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
	<title>news</title>
</head>
<body>
	<a href="/parent/php/videos.php">观看视频</a>
	<a href="news.php">浏览新闻</a>
	<a href='exit.php'>退出登录</a>
	<h2 align="center">已发布新闻</h2>
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
	$sql = "select title,content,datetime from news order by datetime desc";
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
</body>
</html>