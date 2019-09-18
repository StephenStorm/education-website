<html>
<head>
	<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
	<title align="center">发布新闻</title>
</head>
<body>
</body>
<br>
<br>
	<!--按钮并实现页面的跳转-->
	<a class="btn btn-default" href="news.php" role="button">发布新闻</a>
	<a class="btn btn-default" href="video.php" role="button">发布视频</a>	
	<a class="btn btn-default" href="announcement.php" role="button">编辑公告</a>
	<a class="btn btn-default" href="discuss.php" role="button">编辑评论</a>
	<a class="btn btn-default" href="auditing.php" role="button">权限审核</a>
	<a class="btn btn-default" href="video_news.php" role="button">观看视频/阅读新闻</a>		
	<a class="btn btn-default" href="first_page.html" role="button">回到首页</a>
<br>
<br>
<table border = 1 >
    <tr>
    	<th>教育机构/个人教师的用户名</th>
    	<th>标识码/身份证号</th>
    	<th>password</th>
    	<th>角色</th>
    	<th>审核状态</th>
    	<th>电话</th>
    	<th>邮箱</th>
    	<th>适宜年龄（from）</th>
    	<th>适宜年龄（to）</th>
    	<th>学科</th>
    	<th>简介</th>
    	<th>评价（打分制）</th>
    	<th>同意|拒绝</th>
    </tr>

<?php
	echo "<h3>请求审核记录</h3>";
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		//查询新闻  id应该从session中获得
		$sql = "select * from user_edu_tea where state=0 ";
		$show_user_edu_tea0 = $link->query($sql);
		while ( $row = mysqli_fetch_array($show_user_edu_tea0)){
			echo "<tr>";
			echo "<td>".$row['et_id']."</td>";
			echo "<td>".$row['identify']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "<td>".$row['role']."</td>";
			echo "<td>".'请求审核'."</td>";
			echo "<td>".$row['tel']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['age_from']."</td>";
			echo "<td>".$row['age_to']."</td>";
			echo "<td>".$row['area']."</td>";
			echo "<td>".$row['intro']."</td>";
			echo "<td>".$row['evaluation']."</td>";
			echo "
			<td> 
			<a href='pass.php?et_id={$row['et_id']}'>同意</a>  | 
			<a href='Nopass.php?et_id={$row['et_id']}'>拒绝</a> 
			</td>";
			echo "</tr>";
		}
		$link->close();
	}
?>
</table>
</body>
</html>

<html>
<head></head>
<body></body>
<table border = 1 >
    <tr>
    	<th>教育机构/个人教师的用户名</th>
    	<th>标识码/身份证号</th>
    	<th>password</th>
    	<th>角色</th>
    	<th>审核状态</th>
    	<th>电话</th>
    	<th>邮箱</th>
    	<th>适宜年龄（from）</th>
    	<th>适宜年龄（to）</th>
    	<th>学科</th>
    	<th>简介</th>
    	<th>评价（打分制）</th>
    	<th>同意|拒绝</th>
    </tr>

<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		echo "<br/>";
		echo "<h3>通过审查的记录</h3>";
		echo "<br/>";
		$sql = "select * from user_edu_tea where state=1 ";
		$show_user_edu_tea1 = $link->query($sql);
		while ( $row = mysqli_fetch_array($show_user_edu_tea1)){
			echo "<tr>";
			echo "<td>".$row['et_id']."</td>";
			echo "<td>".$row['identify']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "<td>".$row['role']."</td>";
			echo "<td>".'通过审核的记录'."</td>";
			echo "<td>".$row['tel']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['age_from']."</td>";
			echo "<td>".$row['age_to']."</td>";
			echo "<td>".$row['area']."</td>";
			echo "<td>".$row['intro']."</td>";
			echo "<td>".$row['evaluation']."</td>";
			echo "
			<td> 
			<a href='pass.php?et_id={$row['et_id']}'>同意</a>  | 
			<a href='Nopass.php?et_id={$row['et_id']}'>拒绝</a> 
			</td>";
			echo "</tr>";
		}
		$link->close();
	}
?>
</table>
</body>
</html>

<html>
<head></head>
<body></body>
<table border = 1 >
    <tr>
    	<th>教育机构/个人教师的用户名</th>
    	<th>标识码/身份证号</th>
    	<th>password</th>
    	<th>角色</th>
    	<th>审核状态</th>
    	<th>电话</th>
    	<th>邮箱</th>
    	<th>适宜年龄（from）</th>
    	<th>适宜年龄（to）</th>
    	<th>学科</th>
    	<th>简介</th>
    	<th>评价（打分制）</th>
    	<th>同意|拒绝</th>
    </tr>
<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		echo "<h3>未通过审查的记录</h3>";
		echo "<br/>";
		$sql = "select * from user_edu_tea where state=2 ";
		$show_user_edu_tea2 = $link->query($sql);
		while ( $row = mysqli_fetch_array($show_user_edu_tea2)){
			echo "<tr>";
			echo "<td>".$row['et_id']."</td>";
			echo "<td>".$row['identify']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "<td>".$row['role']."</td>";
			echo "<td>".'未通过审核的记录'."</td>";
			echo "<td>".$row['tel']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['age_from']."</td>";
			echo "<td>".$row['age_to']."</td>";
			echo "<td>".$row['area']."</td>";
			echo "<td>".$row['intro']."</td>";
			echo "<td>".$row['evaluation']."</td>";
			echo "
			<td> 
			<a href='pass.php?et_id={$row['et_id']}'>同意</a>  | 
			<a href='Nopass.php?et_id={$row['et_id']}'>拒绝</a> 
			</td>";
			echo "</tr>";
		}

		$link->close();
	}
?>
</table>
</body>
</html>