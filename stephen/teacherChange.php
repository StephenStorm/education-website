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
	<title>message</title>
</head>
<body>
<a href="course.php">课程信息管理</a>
<a href="applyTeacher.php">试听申请列表</a>
<a href="teacherChange.php">基本信息管理</a>
<a href="announcement.php">发布公告</a>
<a href="/parent/php/videos.php">观看视频</a>
<a href="news.php">浏览新闻</a>
<a href='exit.php'>退出登录</a>
	<h2 align="center">修改信息</h2>
	<table align="center" border="1">
		<tr>
			<td>姓名</td>
			<td>年龄</td>
			<td>身份证号</td>
			<td>从业年限</td>
			<td>手机号</td>
			<td>邮箱</td>
			<td>最低年龄</td>
			<td>最高年龄</td>
			<td>教育领域</td>
			<td>简介</td>
		</tr>

<?php
	$mysqli = new mysqli("localhost","root",$password,$parkName);
	//判断连接是否成功
	if($mysqli->connect_errno){
		die($mysqli->connect_error);
	}
	$mysqli->set_charset('utf-8');
	$userid = $_SESSION['userid'];
	$sql = "select * from user_edu_tea natural join teacher where et_id = '$userid'";
	$result = $mysqli->query($sql);
	$myrow=mysqli_fetch_assoc($result);
	echo "<tr>";
	echo"<td>"; echo $myrow['name']; echo "</td>";
	echo"<td>"; echo $myrow['age']; echo "</td>";
	echo"<td>"; echo $myrow['identify']; echo "</td>";
	echo"<td>"; echo $myrow['years']; echo "</td>";
	echo"<td>"; echo $myrow['tel']; echo "</td>";
	echo"<td>"; echo $myrow['email']; echo "</td>";
	echo"<td>"; echo $myrow['age_from']; echo "</td>";
	echo"<td>"; echo $myrow['age_to']; echo "</td>";
	echo"<td>"; echo $myrow['area']; echo "</td>";
	echo"<td>"; echo $myrow['intro']; echo "</td>";
	echo "</tr>";
	$mysqli->close();


?>
</table>
<h2 align="center">修改信息</h2>
<table align="center" border="1"> 
	<form action = teacherChange.php method="post">
		<tr><td colspan="2" align="center">只填写修改项</td></tr>
		<tr>
			<td>姓名</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td>年龄</td>
			<td><input type="text" name="age" pattern="\d{2,3}"></td>
		</tr>
		<tr>
			<td>从业年限</td>
			<td><input type="text" name="years" pattern="\d+"></td>
		</tr>
		<tr>
			<td>手机号</td>
			<td><input type="text" name="tel" pattern="\d{11}"></td>
		</tr>
		<tr>
			<td>邮箱</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td>最低年龄</td>
			<td><input type="text" name="age_from" pattern="\d{1,2}"></td>
		</tr>
		<tr>
			<td>最高年龄</td>
			<td><input type="text" name="age_to" pattern="\d{1,2}"></td>
		</tr>
		<tr>
			<td>教育领域</td>
			<td><input type="text" name="area"></td>
		</tr>
		<tr>
			<td>简介</td>
			<td><input type="text" name="intro"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="change"></td>		
		</tr>
	</form>
</table>
</body>
</html>
<?php 
	if(isset($_POST['change'])){
		$changed=false;
		$tem=$_POST;
		$mysqli=new mysqli('localhost','root',$password,$parkName);
		$mysqli->set_charset('utf8');
		foreach ($tem as $key => $value) {
			if($value!==''&&$key!='change'){
				if($key=='name'||$key=='age'||$key=='years'){
					$sql="update teacher set ".$key."='".$value."' where et_id='".$userid."'";
				}
				else{
					$sql="update user_edu_tea set ".$key."='".$value."' where et_id='".$userid."'";
				}
				
				if($key==='password'){
						$changed=true;
				}
				if($mysqli->query($sql)){
					if($changed){
						echo "<script>
						alert('密码已修改，请重新登录！');
					 	location.href='/login_regist/login.php';
						</script>";
					}
					else{
						echo "<script>
						alert('信息修改成功！');
					 	location.href='teacherChange.php';
						</script>";
						
					}
					
				}
				else{
					echo "<script>
						alert('error Modify');
					 	location.href='teacherChange.php';
						</script>";
				}
			}
		}
		$mysqli->close();
	}
?>