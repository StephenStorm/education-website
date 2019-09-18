<?php
session_start();
if(!isset($_SESSION['username'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	require '../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		exit();
	}
	$result=$db->query('select * from announcement where et_id="'.$_GET['et_id'].'" and title="'.$_GET['title'].'"');
	$announce=$result->fetch_assoc();
	$db->close();
	require '../html/announce.php';
}
?>