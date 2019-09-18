<?php 
session_start();
if(!isset($_SESSION['username'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	$info=array();
	header("Content-Type: application/json; charset=UTF-8");
	$obj =  json_decode($_POST["x"], false);

	require '../../config/common.php';
	$username=$_SESSION['username'];
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		$info['result']=False;
		echo json_encode($info);
		exit();
	}
	$result=$db->query('select c_id from apply_lis where c_id='.$obj->c_id.' and p_id="'.$username.'"');
	if($result->num_rows>0){//需要取消申请
		$result=$db->query('delete from apply_lis where c_id='.$obj->c_id.' and p_id="'.$username.'"');
	}else{//需要提交申请
		$result=$db->query('insert into apply_lis(p_id,c_id,datetime,status) values("'.$username.'",'.$obj->c_id.',"'.date("Y-m-d G:i:s").'",0)');
	}
	$db->close();
	$info['result']=$result;
	echo json_encode($info);
}

?>