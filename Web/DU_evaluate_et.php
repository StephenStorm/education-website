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
<table border = 1 width = 800 >
    <tr>
    	<th>家长用户名</th>
    	<th>教育机构/个人教师的用户名</th>
    	<th>评分（百分制）</th>
    	<th>图片</th>
    	<th>评价的文字描述</th>
    	<th>星级评价(5星制)</th>
    	<th>上传时间</th>
    	<th>修改/删除</th>
    </tr>

<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		//查询新闻  id应该从session中获得
		$sql = "select * from evaluate_et";
		$show_evaluate_et = $link->query($sql);

		while ( $row = mysqli_fetch_array($show_evaluate_et)){
			echo "<tr>";
			echo "<td>".$row['p_id']."</td>";
			echo "<td>".$row['et_id']."</td>";
			echo "<td>".$row['score']."</td>";
			echo "<td><img src='../parent/image/edu/".$row['image']."' width=50 height=50></td>";
			echo "<td>".$row['text']."</td>";
			echo "<td>".$row['star_level']."</td>";
			echo "<td>".$row['datetime']."</td>";
			echo "
			<td> 
			<a href='D_evaluate_et.php?datetime={$row['datetime']}'>删除</a>  | 
			<a href='U_evaluate_et.php?datetime={$row['datetime']}'>修改</a> 
			</td>";
			echo "</tr>";

		}
		$link->close();
	}
?>
 </table>
</body>
</html>