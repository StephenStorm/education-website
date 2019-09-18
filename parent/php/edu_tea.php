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
	$et_id=$_GET['et_id'];
	$result=$db->query("select * from user_edu_tea where et_id=\"$et_id\"");
	$user=$result->fetch_assoc();
	if($user['role']==1){
		$result=$db->query("select * from teacher where et_id=\"$et_id\"");
		$euser=$result->fetch_assoc();
		$user['name']=$euser['name'];
		$user['age']=$euser['age'];
		$user['sex']=$euser['sex'];
		$user['years']=$euser['years'];
	}
	$courses=$db->query('select * from  edu_store natural join course where et_id="'.$et_id.'"');
	
	//获得该机构的所有评价
	$evaluations=$db->query('select * from evaluate_et where et_id="'.$et_id.'"');
	
	
	$db->close();	
	require '../html/edu_tea.php';
}
?>