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

</body>
</html>

<?php
echo '<br/>';
	echo "
		<a href = 'DeleteUpdateAnn.php'>
		<button type='button'>删除/修改公告</button>
		</a>";
?>
