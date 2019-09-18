<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>购物记录</title>

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
		<li><a href="./shopping_cart.php">购物车</a></li>
		<li class="active"><a href="#">购物记录</a></li>		
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
		<div class="col-md-offset-5 h3">购物记录</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-1 col-md-offset-3">课程名称</div>
		<div class="col-md-1">开课机构</div>
		<!-- <div class="col-md-1">起始日期</div>
		<div class="col-md-1">结束日期</div> -->
		<div class="col-md-1">半年数</div>
		<div class="col-md-1">价格/￥</div>
		<div class="col-md-2">购买日期</div>
		<div class="col-md-2">店铺信息</div>
	</div>
	<hr>
	
	<?php
	while($purchase_record=$purchase_records->fetch_assoc()){
		echo '<div class="row record">';
		echo '<div class="col-md-1 col-md-offset-3"><a href="./course.php?c_id='.$purchase_record["c_id"].'">'.$purchase_record['direction'].'</a></div>';
		echo '<div class="col-md-1"><a href="./edu_tea.php?et_id='.$purchase_record["et_id"].'">'.$purchase_record['et_id'].'</a></div>';
		// echo '<div class="col-md-1">'.$purchase_record['date_from'].'</div>';
		// echo '<div class="col-md-1">'.$purchase_record['date_to'].'</div>';
		echo '<div class="col-md-1">'.$purchase_record['length'].'</div>';
		echo '<div class="col-md-1">'.$purchase_record['money'].'</div>';
		echo '<div class="col-md-2">'.$purchase_record['datetime'].'</div>';
		$result=$db->query('select role from user_edu_tea where et_id="'.$purchase_record['et_id'].'"');
		$result=$result->fetch_assoc();
		if($result['role']==0){
			echo '<div class="col-md-2">'.$purchase_record['province'].'省'.$purchase_record['city'].'市'.$purchase_record['district'].$purchase_record['other'].'</div>';
		}
		echo '</div>';
		echo '<hr class="record">';
	}	
	?>
	<div class="row">
		<div class="col-md-1 col-md-offset-5">
			<button type="button" class="btn btn-default" id="<?php echo $username;?>" onclick="clear_purchaserecords(this)">
				<span>清空购物记录</span>
			</button>
		</div>
	</div>
</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">提示</h4>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script> -->
		<script src="../js/jquery-3.3.1.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/purchase_records.js"></script>
	</body>
</html>