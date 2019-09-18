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
	
		$purchase_records=$db->query("select *, fee*length as money from course natural join purchase natural join edu_store where p_id=\"$username\" and state=1 order by datetime desc");
		require '../html/purchase_records.php';
	
	$db->close();
}
?>