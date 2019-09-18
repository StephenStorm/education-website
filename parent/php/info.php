<?php
session_start();
if(!isset($_SESSION['username'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	require '../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		echo "<p>fail to connect to the database.</p>";
	}
	$username=$_SESSION['username'];
	$parent=$db->query("select p_name,tel,email from user_parent where p_id=\"$username\"");
	$parent=$parent->fetch_assoc();
	$childs=$db->query("select * from student where p_id=\"$username\"");
	require '../html/info.php';
	$db->close();
}
?>