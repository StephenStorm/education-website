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
		$info['result']=False;
		echo json_encode($info);
		exit();
	}
	$info['result']=$db->query("update student set birth=\"".$obj->birth."\",sex=\"".$obj->sex."\",direction=\"".$obj->direction."\",fee_to=\"".$obj->fee_to."\",fee_from=\"".$obj->fee_from."\",province=\"".$obj->province."\",city=\"".$obj->city."\",district=\"".$obj->district."\",other=\"".$obj->other."\" where p_id=\"".$obj->p_id."\" and s_name=\"".$obj->s_name."\"");	
	$db->close();
	echo json_encode($info);
}

?>