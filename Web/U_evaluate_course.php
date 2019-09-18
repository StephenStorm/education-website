<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
	//接收数据
	$datetime = $_GET['datetime'];
	//处理数据 根据id查找其他信息
	$sql = "select * from evaluate_course where datetime = '$datetime'";
	
	$res = $link->query( $sql );

	$arr = mysqli_fetch_array( $res );
	$link->close();
	//echo "姓名 ： <input type='text' value='{$arr['sname']}'>";
?>
<form action="UDo_evaluate_et.php" method="post">
	<input type="hidden" name="datetime" value="<?php echo "{$arr['datetime']}";?>"/>
	评分 ： <input type="text" name="score" value="<?php echo "{$arr['score']}";?>"/><br>
	图片 ： <input type="text" name="image" value="<?php echo "{$arr['image']}";?>"/><br>
	内容 ： <input type="text" name="text" value="<?php echo "{$arr['text']}";?>"/><br>
	星级 ： <input type="text" name="star_level" value="<?php echo "{$arr['star_level']}";?>"/><br>
	<input type="submit" value="确认修改"/>
</form>
