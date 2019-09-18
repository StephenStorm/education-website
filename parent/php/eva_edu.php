<?php 
session_start();
if(!isset($_SESSION['username'])){//用户未登录
	require '../html/nologin.php';
}else{//用户已登录
	require '../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		exit();
	}
	$filepath="";
	$username=$_SESSION['username'];
	if(empty($_FILES["file"]['name'])){
		$filepath="";
	}else{
		$filepath="../image/edu/".$username.$_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);
		$filepath=$username.$_FILES["file"]["name"];
	}
	$result=$db->query('select * from evaluate_et where p_id="'.$username.'" and et_id="'.$_POST['et_id'].'"');
	if($result->num_rows>0){//已经有评价,需要更新
		$result=$result->fetch_assoc();
		if(!empty($result['image'])){//需要先删除原来的图片文件
			unlink($result['image']);
		}
		$db->query('update evaluate_et set score="'.$_POST['score'].'",image="'.$filepath.'",text="'.$_POST['text'].'",star_level="'.$_POST['star_level'].'",datetime="'.date("Y-m-d G:i:s").'" where p_id="'.$username.'"and et_id="'.$_POST['et_id'].'"');
		// echo 'update evaluate_et set score="'.$_POST['score'].'",image="'.$filepath.'",text="'.$_POST['text'].'",star_level="'.$_POST['star_level'].'",datetime="'.date("Y-m-d G:i:s").'" where p_id="'.$username.'"and et_id="'.$_POST['et_id'].'"';
	}else{//没有评价,需要添加
		$db->query('insert into evaluate_et(p_id,et_id,score,image,text,star_level,datetime) values("'.$username.'","'.$_POST['et_id'].'","'.$_POST['score'].'","'.$filepath.'",
		"'.$_POST['text'].'","'.$_POST['star_level'].'","'.date("Y-m-d G:i:s").'")');
		// echo $db->error;
	}
	//更新机构好评度
	$result=$db->query('select avg(evaluation) as aa from (select (20*star_level+score)/2 as evaluation from evaluate_et where et_id="'.$_POST['et_id'].'")as temp');
	$evaluation=intval($result->fetch_assoc()['aa']);//课程好评度
	$db->query('update user_edu_tea set evaluation="'.$evaluation.'" where et_id="'.$_POST['et_id'].'"');
	
	$db->close();
	 header("location:./course.php?c_id=".$_POST['c_id']);
}

?>