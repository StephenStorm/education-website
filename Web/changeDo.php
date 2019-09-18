<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
	//接收数据
	$datetime = $_POST['dat'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	//编写sql语句
	$sql = "update news set title = '$title',content='$content' where datetime = '$datetime' ";
	
	$row = $link->query( $sql );
	
	if( $row ){
		echo "<script>alert('修改成功');location.href='news.php';</script>";
	}else{
		echo "<script>alert('修改失败');location.href='change_news.php';</script>";
	}
	$link->close();
?>
