<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>所有用户</title>
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
	<br/>
<a href="add_news.php">添加新闻</a>
<table border = 1 width = 600 >
    <tr>
    	<th>管理员id</th>
    	<th>主题</th>
    	<th>内容</th>
    	<th>上传时间</th>
    	<th>修改/删除</th>
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
			echo "
			<td> 
			<a href='deleteNews.php?datetime={$row['datetime']}'>删除</a>  | 
			<a href='change_news.php?datetime={$row['datetime']}'>修改</a> 
			</td>";
			echo "</tr>";

		}
		$link->close();
	}
?>
 </table>
</body>
</html>