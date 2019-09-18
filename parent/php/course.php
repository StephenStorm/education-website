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
	$c_id=$_GET['c_id'];
	$course=$db->query("select * from course natural join edu_store where c_id=\"$c_id\"");
	$course=$course->fetch_assoc();//获得课程信息
	
	$result=$db->query('select * from purchase where c_id='.$c_id.' and p_id="'.$username.'" and state=1');
	if($result->num_rows>0){//是否购买过该课程
		$purchase=true;
	}else{
		$purchase=false;
	}
	$result=$db->query('select avg(evaluation) as aa from (select (20*star_level+score)/2 as evaluation from evaluate_course where c_id='.$c_id.')as temp');
	$course['evaluation']=intval($result->fetch_assoc()['aa']);//课程好评度
	
	$result=$db->query('select c_id from apply_lis where c_id='.$c_id.' and p_id="'.$username.'" and status=0');
	if($result->num_rows>0){//是否已经申请试听
		$apply=true;
	}else{
		$apply=false;
	}
	
	//获得该课程的所有评价
	$evaluations=$db->query('select * from evaluate_course where c_id="'.$c_id.'"');
	$db->close();
	
	require '../html/course.php';
}
?>