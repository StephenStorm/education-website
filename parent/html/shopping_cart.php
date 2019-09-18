<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>购物车</title>

		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>
		
		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $web; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="./index.php">课程表 <span class="sr-only">(current)</span></a></li>
        <li><a href="./query.php">查询</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">通知 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="./announces.php">公告</a></li>
			<li class="divider"></li>
            <li><a href="./newses.php">新闻</a></li>
			<li class="divider"></li>
            <li><a href="./videos.php">视频</a></li>
          </ul>
        </li>
		<li><a href="./info.php">个人信息</a></li>	
		<li  class="active"><a href="#">购物车</a></li>
		<li><a href="./purchase_records.php">购物记录</a></li>		
      </ul>
	  <ul class="nav navbar-nav navbar-right">
		  <li><a href="./setting.php">设置</a></li>
		  <li><a href="./logout.php">退出</a></li>
	  </ul>
	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-5 h3">购物车</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-1 col-md-offset-2">选择</div>
		<div class="col-md-1">课程名称</div>
		<div class="col-md-1">开课机构</div>
		<div class="col-md-1">半年数</div>
		<div class="col-md-1">价格/￥</div>
		<div class="col-md-2">加入购物车日期</div>
		<div class="col-md-2">店铺信息</div>
		<div class="col-md-1">删除</div>
	</div>
	<hr>
	
	<?php
	if($purchase_records->num_rows>0){
	echo '<form action="./zhifubao/index.php" method="post">';
	while($purchase_record=$purchase_records->fetch_assoc()){
		echo '<div class="row">';
		echo '<div class="col-md-1 col-md-offset-2">
		<input type="checkbox" name="select[]" value="'.$purchase_record["c_id"].'">
		</div>';
		echo '<div class="col-md-1"><a href="./course.php?c_id='.$purchase_record["c_id"].'">'.$purchase_record['direction'].'</a></div>';
		echo '<div class="col-md-1"><a href="./edu_tea.php?et_id='.$purchase_record["et_id"].'">'.$purchase_record['et_id'].'</a></div>';
		echo '<div class="col-md-1">'.$purchase_record['length'].'</div>';
		echo '<div class="col-md-1">'.$purchase_record['money'].'</div>';
		echo '<div class="col-md-2">'.$purchase_record['datetime'].'</div>';
		$result=$db->query('select role from user_edu_tea where et_id="'.$purchase_record['et_id'].'"');
		$result=$result->fetch_assoc();
		if($result['role']==0){
			echo '<div class="col-md-2">'.$purchase_record['province'].'省'.$purchase_record['city'].'市'.$purchase_record['district'].$purchase_record['other'].'</div>';
		}
		echo '<div class="col-md-1">';
		echo '<a href="./delete_purchase_record.php?c_id='.$purchase_record['c_id'].'" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
		echo '</div>';
		echo '</div>';
		echo '<hr>';
	}
	echo '
	<div class="row">
		<div class="col-md-offset-5 col-md-1">
			<input type="submit" value="付款" name="submit" class="btn btn-default">
		</div>
	</div>
	';
	echo '</form>';
	}
	?>
</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script> -->
		<script src="../js/jquery-3.3.1.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>

	</body>
</html>