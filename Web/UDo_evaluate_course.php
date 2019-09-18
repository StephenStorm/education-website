<?php
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
	//接收数据
	$datetime = $_POST['datetime'];
	$score = $_POST['score'];
	$image = $_POST['image'];
	$text = $_POST['text'];
	$star_level = $_POST['star_level'];


	//编写sql语句
	$sql = "update evaluate_course set score = '$score',image='$image',text = '$text',star_level='$star_level' where datetime = '$datetime' ";
	
	$row = $link->query( $sql );
	
	if( $row ){
		echo "<script>alert('修改成功');location.href='discuss.php';</script>";
	}else{
		echo "<script>alert('修改失败');location.href='discuss.php';</script>";
	}
	$link->close();
?>
