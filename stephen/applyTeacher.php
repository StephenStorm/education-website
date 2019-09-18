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
?>

<!DOCTYPE html>
<html>
<head>
	<title>申请列表</title>
</head>
<body>
<a href="course.php">课程信息管理</a>
<a href="applyTeacher.php">试听申请列表</a>
<a href="teacherChange.php">基本信息管理</a>
<a href="announcement.php">发布公告</a>
<a href="/parent/php/videos.php">观看视频</a>
<a href="news.php">浏览新闻</a>
<a href='exit.php'>退出登录</a>
<table align="center" border="1">
	<h2 align="center">个人教师申请列表</h2>
	<tr>
		<td>申请用户</td>
		<td>申请课程</td>
		<td>申请时间</td>
		<td>申请人电话</td>
		<td>操作</td>
	</tr>
<?php
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$mysqli->set_charset('utf-8');
	$sql = "select p_id,c_id,direction,p_name,datetime,tel from user_parent natural join apply_lis natural join course 
	where status = 0 and es_id = (
	select es_id from edu_store where et_id = '".$userid."')";
	$result=$mysqli->query($sql);
	while($myrow = mysqli_fetch_assoc($result)){
		echo "<form action ='applyTeacher.php' method = 'post'>";
		echo "<tr>";
		echo "<input type='text' name= 'pid' value = '".$myrow['p_id']."' hidden>";
		echo "<input type='text' name= 'cid' value = '".$myrow['c_id']."' hidden>";
		echo "<td>"; echo $myrow['p_name']; echo "</td>";
		echo "<td>"; echo $myrow['direction']; echo "</td>";
		echo "<td>"; echo $myrow['datetime']; echo "</td>";
		echo "<td>"; echo $myrow['tel'];echo "</td>";
		echo "<td><input type = 'submit' name = 'agree' value = '同意'>&nbsp<input type = 'submit' name ='dis' value = '拒绝'>";
		echo "</tr></form>";
	}
	$mysqli->close();
?>
</table>
</body>
</html>
<?php
	$tem=$_POST;
	$mysqli=new mysqli('localhost','root',$password,$parkName);
	$mysqli->set_charset('utf8');
	if(isset($_POST['agree'])){
		$_POST['agree'] = false;
		$sql = "update apply_lis set status = 1 where p_id ='".$_POST['pid']."' and c_id ='".$_POST['cid']."'";
		if(!$mysqli->query($sql)){
			echo "<script>
				alert('操作失败！');
			 	location.href='teacherLogin.php';
				</script>";	
		}
		echo "<script>location.href='applyTeacher.php';</script>";
	}
	if(isset($_POST['dis'])){
		$_POST['dis'] = false;
		$sql = "update apply_lis set status = 2 where p_id ='".$_POST['pid']."' and c_id ='".$_POST['cid']."'";
		if(!$mysqli->query($sql)){
			echo "<script>
				alert('操作失败！');
			 	location.href='teacherLogin.php';
				</script>";	
		}
		echo "<script>location.href='applyTeacher.php';</script>";
	}
	$mysqli->close();
	

?>
