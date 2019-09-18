<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加新闻</title>
</head>
<body>

	<form method="post" action="add_news.php">	
	<div class="form-group">
	    <label for="firstname" class="col-sm-2 control-label">标题</label>
 	    <div class="col-sm-10">
    	    <input type="text" class="form-control" name="title" placeholder="请输入标题">
      	</div>
   </div>
   <br/>
   <div class="form-group">
	    <label for="firstname" class="col-sm-2 control-label">内容</label>
 	    <div class="col-sm-10">
    	    <input type="text" class="form-control" name="content" placeholder="请输入内容">
      	</div>
   </div>
   <br/>
   <input type="submit" name = "sub" value="提交" >
   </form>
</body>
</html>

<?php
//添加新闻

if(isset($_POST['sub'])){
	//将网页上输入的内容保存到变量中
	$rec_title = $_POST['title'];
	$rec_content = $_POST['content'];
	//系统自动获得当前时间。按照一定格式
	$rec_datetime = date("Y-m-d G:i:s");
	//连接数据库
	$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
	if($link->connect_errno){	
		exit();
	}else{
		//插入id应该从session中获得
		$sql = "insert into news values('$_SESSION[username]','$rec_title','$rec_content','$rec_datetime')";
		$row = $link->query( $sql );
    	//返回结果
    	if( $row ){
    		echo "<script>alert('添加成功');location.href='news.php';</script>";
    	}else{
    		echo "<script>alert('添加失败');location.href='news.php';</script>";
    	}
    	$link->close();
	}
}
?>