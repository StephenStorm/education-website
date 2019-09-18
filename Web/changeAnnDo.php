<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
	//接收数据
	$datetime = $_POST['date'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	//编写sql语句
	$sql = "update announcement set title = '$title',content = '$content' where datetime = '$datetime' ";
	
	$row = $link->query( $sql );
	
	if( $row ){
		echo "<script>alert('修改成功');location.href='announcement.php';</script>";
	}else{

		echo "<script>alert('修改失败');location.href='announcement.php';</script>";
	}
	$link->close();
?>
