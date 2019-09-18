<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>教育机构信息</title>

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
      <a class="navbar-brand" href="./index.php"><?php echo $web; ?></a>
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
		<div class="col-md-offset-5 h3">
			<?php 
			if($user['role']==0){
				echo "教育机构信息";
			}else{
				echo "个人教师信息";
			}
			?>
		</div>
	</div>
	<div class="row">
	<?php 
	if($user['role']==0){
		?>
		<div class="col-md-1 col-md-offset-3">教育领域</div>
		<div class="col-md-1">标识码</div>
		<div class="col-md-1">教育起止年龄</div>
		<div class="col-md-1">联系方式</div>
		<div class="col-md-1">好评度</div>
		<div class="col-md-4">简介</div>
		<?php }else{
		?>
		<div class="col-md-1">姓名</div>
		<div class="col-md-1">性别</div>
		<div class="col-md-1">年龄</div>
		<div class="col-md-1">教育领域</div>
		<div class="col-md-1">从教年限</div>
		<div class="col-md-1">教育起止年龄</div>
		<div class="col-md-2">身份证号</div>
		<div class="col-md-1">联系方式</div>
		<div class="col-md-1">好评度</div>
		<div class="col-md-2">简介</div>
		<?php }?>
	</div>
	<hr>
	<div class="row">
	<?php 
	if($user['role']==0){
		echo '
		<div class="col-md-1 col-md-offset-3">'.$user['area'].'</div>
		<div class="col-md-1">'.$user['identify'].'</div>
		<div class="col-md-1">'.$user['age_from']."-".$user['age_to'].'</div>
		<div class="col-md-1">'.$user['tel'].'</div>
		<div class="col-md-1">'.$user['evaluation'].'</div>
		<div class="col-md-4">'.$user['intro'].'</div>';
		}else{
			if($user['sex']=0){
				$user['sex']='男';
			}else{
				$user['sex']='女';
			}
		echo '
		<div class="col-md-1">'.$user['name'].'</div>
		<div class="col-md-1">'.$user['direction'].'</div>		
		<div class="col-md-1">'.$user['sex'].'</div>
		<div class="col-md-1">'.$user['direction'].'</div>
		<div class="col-md-1">'.$user['years'].'</div>
		<div class="col-md-1">'.$user['age_from']."-".$user['age_to'].'</div>
		<div class="col-md-2">'.$user['identify'].'</div>
		<div class="col-md-1">'.$user['tel'].'</div>
		<div class="col-md-1">'.$user['evaluation'].'</div>
		<div class="col-md-2">'.$user['intro'].'</div>
		';
		}?>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-offset-5 h3">
		开设的课程信息
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 col-md-offset-3">课程名称</div>
		<!-- <div class="col-md-1">起始日期</div>
		<div class="col-md-1">结束日期</div> -->
		<div class="col-md-2">价格/(￥/半年)</div>
		<?php
		if($user['role']==0){
			echo '<div class="col-md-2">店铺信息</div>';
		}
		?>
	</div>
	<hr>
	
	<?php
	while($course=$courses->fetch_assoc()){
		echo '<div class="row">';
		echo '<div class="col-md-1 col-md-offset-3"><a href="./course.php?c_id='.$course["c_id"].'">'.$course['direction'].'</a></div>';
		// echo '<div class="col-md-1">'.$course['date_from'].'</div>';
		// echo '<div class="col-md-1">'.$course['date_to'].'</div>';
		echo '<div class="col-md-2">'.$course['fee'].'</div>';
		if($user['role']==0){
			echo '<div class="col-md-2">'.$course['province'].'省'.$course['city'].'市'.$course['district'].$course['other'].'</div>';
		}
		echo '</div>';
		echo '<hr>';
	}
	echo '<hr>';
	echo '<div class="row">';
	echo '<div class="col-md-offset-5 h3">评价</div>';
	echo '</div>';
	echo '<hr>';
	echo '
		<div class="row">
			<div class="col-md-1 col-md-offset-1">评分(0-100)</div>
			<div class="col-md-2">星级评分(0-5)</div>
			<div class="col-md-3">文本评价</div>
			<div class="col-md-3">图片</div>
			<div class="col-md-1">评价人</div>
			<div class="col-md-1">日期</div>
		</div>';
		echo '<hr>';
		while($evaluation=$evaluations->fetch_assoc()){
			echo '
			<div class="row">
				<div class="col-md-1 col-md-offset-1">'.$evaluation['score'].'</div>
				<div class="col-md-2">'.$evaluation['star_level'].'</div>
				<div class="col-md-3">'.$evaluation['text'].'</div>
				<div class="col-md-3"><img alt="评价人没有提供图片" width="70" src="/parent/image/edu/'.$evaluation['image'].'" /></div>
				<div class="col-md-1">'.$evaluation['p_id'].'</div>
				<div class="col-md-1">'.$evaluation['datetime'].'</div>
			</div>';
			echo '<hr>';
			
		}
	?>
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
	</body>
</html>