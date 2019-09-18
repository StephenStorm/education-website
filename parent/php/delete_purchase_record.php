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
	$username=$_SESSION['username'];
	$db->query('delete from purchase where p_id="'.$username.'" and c_id="'.$_GET['c_id'].'"');
	$db->close();
	header("location:./shopping_cart.php");
}
?>