<?php
	//连接数据库
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}
    	//get 是路径传值    post非路径传值
    	//删除功能
    	//接收数据  接收id
    	$et_id = $_GET['et_id'];
    	//处理数据  操作数据
    	$sql = "update user_edu_tea set state = '2' where et_id='$et_id' ";
    	$row = $link->query( $sql );
    	//返回结果
    	if( $row ){
    		echo "<script>alert('拒绝申请');location.href='auditing.php';</script>";
    	}else{
    		echo "<script>alert('拒绝申请出现错误');location.href='auditing.php';</script>";
    	}
    	$link->close();
?>
