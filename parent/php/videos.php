<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['userid'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	require '../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		exit();
	}
	$announces=$db->query('select * from video order by datetime desc');
	$db->close();
	require '../html/videos.php';
}
?>