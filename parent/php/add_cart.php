<?php 
session_start();
if(!isset($_SESSION['username'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	$username=$_SESSION['username'];
	$info=array();
	header("Content-Type: application/json; charset=UTF-8");
	$obj =  json_decode($_POST["x"], false);
	require '../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		$info['result']=False;
		echo json_encode($info);
		exit();
	}
	$info['result']=$db->query('insert into purchase(p_id,c_id,length,datetime,state)values("'.$username.'","'.$obj->c_id.'","'.$obj->length.'","'.date("Y-m-d G:i:s").'",0)');	
	$db->close();
	echo json_encode($info);
}

?>