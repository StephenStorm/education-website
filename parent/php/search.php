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
	$username=$_SESSION['username'];
	$sql='select distinct et_id,role,evaluation from user_edu_tea natural join edu_store natural join course where true';
	if($obj->subject!='0'){
		$sql.=' and area="'.$obj->subject.'"';
	}
	if($obj->province!='0'){
		$sql.=' and province="'.$obj->province.'"';
		if($obj->city!='0'){
			$sql.=' and city="'.$obj->city.'"';
		}
	}
	if((!empty($obj->fee_from))and(!empty($obj->fee_to))){
		if(intval($obj->fee_from)<=intval($obj->fee_to)){
			$sql.=' and fee >= "'.$obj->fee_from.'" and fee <= "'.$obj->fee_to.'"';
		}
	}
	if((!empty($obj->age_from))and(!empty($obj->age_to))){
		if(intval($obj->age_from)<=intval($obj->age_to)){
			$sql.=' and age_from >= "'.$obj->age_from.'" and age_to <= "'.$obj->age_to.'"';
		}
	}
	$sql.=' order by evaluation desc,role asc';
	$result=$db->query($sql);
	if(!$result){
		$info['result']=false;
	}else{
		$str='';
		while($unit=$result->fetch_assoc()){
			if($unit['role']==0){
				$role="教育机构";
			}else{
				$role="个人教师";
			}
			$str.= '
			<div class="row">
			<div class="col-md-2 col-md-offset-3">
				<a href="./edu_tea.php?et_id='.$unit["et_id"].'">'.$unit['et_id'].'</a>
			</div>
			<div class="col-md-1">'.$unit['evaluation'].'</div>
			<div class="col-md-2">'.$role.'</div>
		</div>
		<hr>
		'; 
		}
		$info['result']=$str;
	}
	$db->close();
	echo json_encode($info);
}

?>