<?php  
session_start();
include "config/datebase.php";
if(!isset($_SESSION['userid'])){
	echo "<script>
		alert('请先登录！');
		location.href='../login.html';
		</script>";
}
//$_SESSION['userid']="000001";
$userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>course</title>
	<meta charset="utf-8">
</head>
<body>
<a href="course.php">课程信息管理</a>
<a href="applyTeacher.php">试听申请列表</a>
<a href="teacherChange.php">基本信息管理</a>
<a href="announcement.php">发布公告</a>
<a href="/parent/php/videos.php">观看视频</a>
<a href="news.php">浏览新闻</a>
<a href='exit.php'>退出登录</a>
<h2 align="center">已开设课程</h2>
<table align="center" border="1">
	<tr>
		<td>课程ID</td>
		<td>课程名</td>
		<td>授课教师</td>
		<td>开始时间</td>
		<td>截止时间</td>
		<td>教室</td>
		<td>费用</td>
		<td>内容</td>
	</tr>
	<?php
		$mysqli = new mysqli("localhost","root",$password,$parkName);
		//判断连接是否成功
		if($mysqli->connect_errno){
			die($mysqli->connect_error);
		}
		$userid = $_SESSION['userid'];
		$mysqli->set_charset('utf-8');
		$sql = "select * from course natural join edu_store where et_id='$userid'";
		$result = $mysqli->query($sql);
		while($myrow = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>"; echo $myrow['c_id']; echo "</td>";
			echo "<td>"; echo $myrow['direction']; echo "</td>";
			echo "<td>"; echo $myrow['teacher_name']; echo "</td>";
			echo "<td>"; echo $myrow['date_from']; echo "</td>";
			echo "<td>"; echo $myrow['date_to']; echo "</td>";
			echo "<td>"; echo $myrow['classroom']; echo "</td>";
			echo "<td>"; echo $myrow['fee']; echo "</td>";
			echo "<td>"; echo $myrow['content']; echo "</td>";
			echo "</tr>";
		}
		$mysqli->close();
	?>

</table>
<h2 align="center">添加课程</h2>
<table border="1" align="center">
	<form action="course.php" method="post">
		<tr>
			<td>输入项</td>
			<td>内容</td>
		</tr>
		<tr>
			<td>开始时间</td>
			<td><input type="date" name="start" required="required"></td>
		</tr>
		<tr>
			<td>截止时间</td>
			<td><input type="date" name="end" required="required"></td>
		</tr>
		<tr>
			<td>教室</td>
			<td><input type="text" name="classroom" required="required"></td>
		</tr>
		<tr>
			<td>费用</td>
			<td><input type="text" name="fee" required="required" pattern="\d+"></td>
		</tr>
		<tr>
			<td>课程名称</td>
			<td><input type="text" name="cname" required="required"></td>
		</tr>
		<tr>
			<td>内容</td>
			<td><input type="text" name="content" required="required"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="subcou" value="yes"></td></tr>
	</form>

</table>
<h2 align="center">修改课程信息</h2>
<table align="center" border="1"> 
	<form action = course.php method="post">
		<tr><td colspan="2" align="center">只填写修改项</td></tr>
		<tr>
			<td>课程ID</td>
			<td><input type="text" name="c_id" required="required"></td>
		</tr>
		<tr>
			<td>开始时间</td>
			<td><input type="date" name="date_from" ></td>
		</tr>
		<tr>
			<td>结束时间</td>
			<td><input type="date" name="date_to" ></td>
		</tr>
		<tr>
			<td>教室</td>
			<td><input type="text" name="classroom"></td>
		</tr>
		<tr>
			<td>授课教师</td>
			<td><input type="text" name="teacher_name"></td>
		</tr>
		<tr>
			<td>课程内容</td>
			<td><input type="text" name="content"></td>
		</tr>
		<tr>
			<td>费用</td>
			<td><input type="text" name="fee" pattern="\d+"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="change" value="modify">&nbsp<input type="submit" name="del" value="del"></td>		
		</tr>
	</form>
</table>
</body>
</html>
<?php 
if(isset($_POST['subcou'])){
	$start = $_POST['start'];
	$end = $_POST['end'];
	$fee = $_POST['fee'];
	$loc = $_POST['classroom'];
	$cname = $_POST['cname'];
	$con = $_POST['content'];
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$userid = $_SESSION['userid'];
	$mysqli->set_charset('utf-8');	
	//查找教师姓名
	$sql = "select name from teacher where et_id = '$userid'";
	$result = $mysqli->query($sql);
	$myrow = mysqli_fetch_assoc($result);
	$teacherName = $myrow['name'];
	//查找教师机构
	$sql = "select es_id from edu_store where et_id = '$userid'";
	$result = $mysqli->query($sql);
	$myrow = mysqli_fetch_assoc($result);
	$es_id = $myrow['es_id'];
	$sql = "insert into course (date_from,date_to,fee,teacher_name,direction,content,es_id,classroom) values('$start','$end','$fee','$teacherName','$cname','$con','$es_id','$loc')";
	if($mysqli->query($sql)){
		echo "<script>
				alert('添加课程成功！');
				location.href='course.php';
				</script>";
	}
	else{
		echo "<script>
				alert('添加课程失败！');
				location.href='course.php';
				</script>";
	}
	$mysqli->close();
}
if(isset($_POST['change'])){
	$_POST['change']=false;
	$tem=$_POST;
	$mysqli=new mysqli('localhost','root',$password,$parkName);
	$mysqli->set_charset('utf8');
	foreach ($tem as $key => $value) {
		if($value!==''&&$key!='change'){
			$sql="update course set ".$key."='".$value."' where c_id='".$_POST['c_id']."'";
		}
		if($mysqli->query($sql)){
			echo "<script>
				alert('课程修改成功！');
				location.href='course.php';
				</script>";
		}
		else{
			echo "insert error !";
		}
	}
	$mysqli->close();
}
if(isset($_POST['del'])){
	$_POST['del'] = false;
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$mysqli->set_charset('utf-8');	
	//查找教师姓名
	$sql = "delete from course where c_id = '".$_POST['c_id']."'";
	if($mysqli->query($sql)){
		echo "<script>
			alert('课程已成功删除！');
		 	location.href='course.php';
			</script>";
	}
	else{
		echo "del error !";
	}
	$mysqli->close();
}
?>