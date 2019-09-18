<?php
	//连接数据库
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
    	//get 是路径传值    post非路径传值
    	//删除功能
    	//接收数据  接收id
    	$datetime = $_GET['datetime'];
    	//处理数据  操作数据
    	$sql = "delete from news where datetime='$datetime' ";
    	$row = $link->query( $sql );
    	//返回结果
    	if( $row ){
    		echo "<script>alert('删除成功');location.href='news.php';</script>";
    	}else{
    		echo "<script>alert('删除失败');location.href='news.php';</script>";
    	}
    	$link->close();
?>
