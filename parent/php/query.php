<?php 
session_start();
if(!isset($_SESSION['username'])){
	require '../html/nologin.php';
}else{
	require '../../config/common.php';
	$username=$_SESSION['username'];
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		exit();
	}
	$objects=$db->query('select distinct area from user_edu_tea');
	$provinces=$db->query('select distinct province from user_edu_tea natural join edu_store');
	$cities=$db->query('select distinct city from user_edu_tea natural join edu_store');
	$units=$db->query('select * from user_edu_tea order by evaluation desc,role asc');//按照好评度递减
	
	require '../html/query.php';
	$db->close();
}
//session_destroy();//临时
?>