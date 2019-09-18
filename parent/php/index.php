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
	$courses=$db->query('select *  from purchase natural join course natural join edu_store where p_id="'.$username.'" and state=1');
	
	require '../html/index.php';
	$db->close();
}
//session_destroy();//临时
?>