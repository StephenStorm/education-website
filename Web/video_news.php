<?php
echo '
<html>
<head>
	<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
	<title align="center">观看视频/阅读新闻</title>
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
</body>
</html>'
;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>视频和新闻</title>
    <style>
        table{
            border-collapse: collapse;
        }
        th,td{
            border:1px solid #ccccff;
            padding: 5px;
        }
        td{
            text-align: center;
        }
    </style>
</head>
<body>
<table border = 1 width = 600 >
    <tr>
    	<th>管理员ID</th>
    	<th>主题</th>
    	<th>内容</th>
    	<th>上传时间</th>
    </tr>

<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		//查询新闻  id应该从session中获得
		$sql = "select * from news";
		$show_news = $link->query($sql);

		while ( $row = mysqli_fetch_array($show_news)){
			echo "<tr>";
			echo "<td>".$row['a_id']."</td>";
			echo "<td>".$row['title']."</td>";
			echo "<td>".$row['content']."</td>";
			echo "<td>".$row['datetime']."</td>";
			echo "</tr>";

		}
		echo "<br/>";
		echo "<br/>";
	}
?>
 </table>
<table border = 1 width = 600 >
    <tr>
    	<th>视频上传者</th>
    	<th>视频</th>
    	<th>题目</th>
    	<th>简介</th>
    	<th>上传时间</th>
    </tr>

<?php
		$sql = "select * from video";
		$show_video = $link->query($sql);
		echo "<br/>";
		while ( $row = mysqli_fetch_array($show_video)){
			echo "<tr>";
			echo "<td>".$row['a_id']."</td>";
			echo "<td>
			<video id='video1' width=420 controls='controls'>
     		<source src='/video/".$row['video_path']."' type='video/mp4'> </video></td>
			";
			echo "<td>".$row['title']."</td>";
			echo "<td>".$row['content']."</td>";
			echo "<td>".$row['datetime']."</td>";
			echo "</tr>";
		}

		$link->close();
?>
 </table>
</body>
</html>