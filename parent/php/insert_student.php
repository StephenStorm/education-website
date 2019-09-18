<?php 
session_start();
if(!isset($_SESSION['username'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	$info=array();
	header("Content-Type: application/json; charset=UTF-8");
	$obj =  json_decode($_POST["x"], false);
	require '../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		$info['result']=1;
		echo json_encode($info);
		exit();
	}
	
	if(strlen($obj->fee_from)==0)
		$obj->fee_from=0;
	if(empty($obj->fee_to))
		$obj->fee_to=0;
	if(empty($obj->birth)){
		$obj->birth=date('Y-m-d');
	}
	$info['result']=$db->query('insert into student (p_id,s_name,birth,sex,direction,fee_from,fee_to,province,city,district,other) values ("'.$obj->p_id.'","'.$obj->s_name.'","'.$obj->birth.'","'.$obj->sex.'","'.$obj->direction.'","'.$obj->fee_from.'","'.$obj->fee_to.'","'.$obj->province.'","'.$obj->city.'","'.$obj->district.'","'.$obj->other.'")');
	$db->close();
	echo json_encode($info);

}

?>