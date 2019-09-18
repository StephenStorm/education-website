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
	$username=$_SESSION['username'];
	if(empty($_FILES["file"]['name'])){
		$filename="";
	}else{
		$filepath="../image/course/".$username.$_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);
		$filepath=$username.$_FILES["file"]["name"];
	}
	$result=$db->query('select * from evaluate_course where p_id="'.$username.'"');
	if($result->num_rows>0){//已经有评价,需要更新
		$result=$result->fetch_assoc();
		if(!empty($result['image'])){//需要先删除原来的图片文件
			unlink($result['image']);
		}
		$db->query('update evaluate_course set score="'.$_POST['score'].'",image="'.$filepath.'",text="'.$_POST['text'].'",star_level="'.$_POST['star_level'].'",datetime="'.date("Y-m-d G:i:s").'" where p_id="'.$username.'"and c_id="'.$_POST['c_id'].'"');
	}else{//没有评价,需要添加
		$db->query('insert into evaluate_course(p_id,c_id,score,image,text,star_level,datetime) values("'.$username.'","'.$_POST['c_id'].'","'.$_POST['score'].'","'.$filepath.'",
		"'.$_POST['text'].'","'.$_POST['star_level'].'","'.date("Y-m-d G:i:s").'")');
	}
	$db->close();
	header("location:./course.php?c_id=".$_POST['c_id']);
}

?>