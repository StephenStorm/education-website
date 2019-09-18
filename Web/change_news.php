<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
	//接收数据
	$datetime = $_GET['datetime'];
	//处理数据 根据id查找其他信息
	$sql = "select * from news where datetime = '$datetime' ";
	
	$res = $link->query( $sql );

	$arr = mysqli_fetch_array( $res );
	$link->close();
	//echo "姓名 ： <input type='text' value='{$arr['sname']}'>";
?>
<form action="changeDo.php" method="post">
	<input type="hidden" name="dat" value="<?php echo "{$arr['datetime']}";?>"/>
	主题 ： <input type="text" name="title" readonly value="<?php echo "{$arr['title']}";?>"/><br>
	内容 ： <input type="text" name="content" value="<?php echo "{$arr['content']}";?>"/><br>
	<input type="submit" value="确认修改"/>
</form>
