<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>编辑公告</title>
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
    	<th>教育机构/个人教师的用户名</th>
    	<th>公告主题</th>
    	<th>公告内容</th>
    	<th>公告上传时间</th>
    	<th>修改/删除</th>
    </tr>
<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		//查询新闻  id应该从session中获得
		$sql = "select * from announcement";
		$ShowAnnouncement= $link->query($sql);

		while ( $row = mysqli_fetch_array($ShowAnnouncement)){
			echo "<tr>";
			echo "<td>".$row['et_id']."</td>";
			echo "<td>".$row['title']."</td>";
			echo "<td>".$row['content']."</td>";
			echo "<td>".$row['datetime']."</td>";
			echo "
			<td> 
			<a href='deleteAnn.php?datetime={$row['datetime']}'>删除</a>  | 
			<a href='changeAnn.php?datetime={$row['datetime']}'>修改</a> 
			</td>";
			echo "</tr>";

		}
		$link->close();
	}
?>
 </table>
</body>
</html>