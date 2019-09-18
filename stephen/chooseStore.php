<?php  
session_start();
include "config/datebase.php";
//$_SESSION['userid']="000002";
if(!isset($_SESSION['userid'])){
	echo "<script>
		alert('请先登录！');
		location.href='../login_regist/login.php';
		</script>";
}

$userid = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>选择店铺</title>
	<meta charset="utf-8">
	<script type="text/javascript" src=js/fresh.js></script>
</head>
<body>
	<a href="chooseStore.php" align="center">管理课程</a>
	<a href="eduMessage.php" align="center">机构信息</a>
	<a href="announcement.php">发布公告</a>
	<a href="/parent/php/videos.php">观看视频</a>
	<a href="news.php">浏览新闻</a>
<a href='exit.php'>退出登录</a>
		<h2 align="center">选择店铺</h2>
	<table align="center" border="1">
		<form action="chooseStore.php" method="post">
			<tr>
				<td>
					<select  id="selEs">
<?php
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$mysqli->set_charset('utf-8');
	$userid = $_SESSION['userid'];
	if(!isset($_SESSION['es_id'])){
		$sql = "select es_id from edu_store where et_id='$userid'";
		$result = $mysqli->query($sql);
		$myrow = mysqli_fetch_assoc($result);
		$_SESSION['es_id'] = $myrow['es_id'];
	}
	$sql = "select * from edu_store where et_id = '$userid'";
	$result = $mysqli->query($sql);
	while($myrow=mysqli_fetch_assoc($result)){
		echo "<option value ='".$myrow['es_id']."'";
		if($myrow['es_id']==$_SESSION['es_id'])  echo "selected";
		echo ">";
		echo $myrow['province'].$myrow['city'].$myrow['district'].$myrow['other'];
		echo "</option>";
	}
	$mysqli->close();
?>
					</select>	
				</td>
				<td>
					<input type="submit" name="sub1" value="yes" onclick="get_es_id()">
				</td>
			</tr>
			<input type="text" name="es1" hidden="hidden" id="esid">
		</form>
	</table>
	<h2 align="center">店铺课程表</h2>
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
		//显示店铺课程表
		$mysqli = new mysqli("localhost","root",$password,$parkName);
		//判断连接是否成功
		if($mysqli->connect_errno){
			die($mysqli->connect_error);
		}
		$mysqli->set_charset('utf-8');
		$sql = "select * from course where es_id= ".$_SESSION['es_id'];
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




<table align="center" border="1">
	<h2 align="center">店铺申请列表</h2>
	<tr>
		<td>申请用户</td>
		<td>申请课程</td>
		<td>申请时间</td>
		<td>操作</td>
	</tr>
<?php
	$userid = $_SESSION['userid'];
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$mysqli->set_charset('utf-8');
	$sql = "select p_id,c_id,direction,p_name,datetime from user_parent natural join apply_lis natural join course 
	where status = 0 and es_id = ".$_SESSION['es_id'];
	$result=$mysqli->query($sql);
	while($myrow = mysqli_fetch_assoc($result)){
		echo "<form action ='chooseStore.php' method = 'post'>";
		echo "<tr>";
		echo "<input type='text' name= 'pid' value = '".$myrow['p_id']."' hidden>";
		echo "<input type='text' name= 'cid' value = '".$myrow['c_id']."' hidden>";
		echo "<td>"; echo $myrow['p_name']; echo "</td>";
		echo "<td>"; echo $myrow['direction']; echo "</td>";
		echo "<td>"; echo $myrow['datetime']; echo "</td>";
		echo "<td><input type = 'submit' name = 'agree' value = '同意'>&nbsp<input type = 'submit' name ='dis' value = '拒绝'>";
		echo "</tr></form>";
	}
	$mysqli->close();
?>
</table>



</table>
<h2 align="center">添加课程</h2>
<table border="1" align="center">
	<form action="chooseStore.php" method="post">
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
			<td>授课教师</td>
			<td><input type="text" name="tname" required="required"></td>
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
	<form action = chooseStore.php method="post">
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
//添加课程
if(isset($_POST['subcou'])){
	$start = $_POST['start'];
	$end = $_POST['end'];
	$fee = $_POST['fee'];
	$loc = $_POST['classroom'];
	$cname = $_POST['cname'];
	$con = $_POST['content'];
	$teacherName = $_POST['tname'];
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$userid = $_SESSION['userid'];
	$mysqli->set_charset('utf-8');	

	$es_id = $_SESSION['es_id'];
	$sql = "insert into course (date_from,date_to,fee,teacher_name,direction,content,es_id,classroom) values('$start','$end','$fee','$teacherName','$cname','$con','$es_id','$loc')";
	if($mysqli->query($sql)){
		echo "<script>
				alert('添加课程成功！');
				location.href='chooseStore.php';
				</script>";
	}
	else{
		echo "insert error !";
	}
	$mysqli->close();
}
if(isset($_POST['change'])){
	//修改课程信息
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
				location.href='chooseStore.php';
				</script>";
		}
		else{
			echo "insert error !";
		}
	}
	$mysqli->close();
}
if(isset($_POST['del'])){
	//删除课程 
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
		 	location.href='chooseStore.php';
			</script>";
	}
	else{
		echo "del error !";
	}
	$mysqli->close();
}

if(isset($_POST['sub1'])){
	$_SESSION['es_id'] = $_POST['es1'];
	echo "here";
	echo $_SESSION['es_id'];
	echo "<script>
	 	location.href='chooseStore.php';
		</script>";
}
if(isset($_POST['agree'])||isset($_POST['dis'])){
	$mysqli=new mysqli('localhost','root',$password,$parkName);
	$mysqli->set_charset('utf8');
	if(isset($_POST['agree'])){
		$_POST['agree'] = false;
		$sql = "update apply_lis set status = 1 where p_id ='".$_POST['pid']."' and c_id ='".$_POST['cid']."'";
		if(!$mysqli->query($sql)){
			echo $sql;
			echo "<script>
				alert('操作失败！');location.href='chooseStore.php';
				</script>";	
		}
		echo "<script>location.href='chooseStore.php';</script>";
	}
	if(isset($_POST['dis'])){
		$_POST['dis'] = false;
		$sql = "update apply_lis set status = 2 where p_id ='".$_POST['pid']."' and c_id ='".$_POST['cid']."'";
		if(!$mysqli->query($sql)){
			echo "<script>
				alert('操作失败！');
			 	location.href='chooseStore.php';
				</script>";	
		}
		echo "<script>location.href='chooseStore.php';</script>";
	}
	$mysqli->close();
}
?>