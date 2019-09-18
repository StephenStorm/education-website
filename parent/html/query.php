<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>查询</title>

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
        <li class="active"><a href="#">查询</a></li>
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
		
	<div class="container-fluid" id="mybody">
		<div class="row">
			<div class="col-md-2">
				<select id="subject" class="form-control" onchange="search()">
					<option value="0" selected="selected">请选择科目</option>
					<?php 
					while($object=$objects->fetch_assoc()){
						echo '
						<option value="'.$object['area'].'">'.$object['area'].'</option>
						';
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="" id="province" class="form-control">
					<option value="0" selected="selected">请选择省份</option>
					<?php 
					while($province=$provinces->fetch_assoc()){
						echo '
						<option value="'.$province['province'].'">'.$province['province'].'</option>
						';
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="" id="city" class="form-control">
					<option value="0" selected="selected">请选择城市</option>
					<?php 
					while($city=$cities->fetch_assoc()){
						echo '
						<option value="'.$city['city'].'">'.$city['city'].'</option>
						';
					}
					?>
				</select>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-5">
						<input type="number" id="age_from" min="1" max="120" class="form-control" placeholder="下限">
					</div>
					<div class="col-md-2">
						<label for="">年龄</label>
					</div>
					<div class="col-md-5">
						<input type="number" id="age_to" min="1" max="120" class="form-control" placeholder="上限">
					</div>
				</div>				
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-5">
						<input type="number" id="fee_from" min="0" class="form-control" placeholder="下限">
					</div>
					<div class="col-md-2">
						<label for="">价格</label>
					</div>
					<div class="col-md-5">
						<input type="number" id="fee_to" min="0" class="form-control" placeholder="上限">
					</div>
				</div>				
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-2 col-md-offset-3">
				教育单位
			</div>
			<div class="col-md-1">好评度</div>
			<div class="col-md-2">教育机构/个人教师</div>
		</div>
		<hr>
		<div id="replace">
		<?php
		while($unit=$units->fetch_assoc()){
			if($unit['role']==0){
				$role="教育机构";
			}else{
				$role="个人教师";
			}
			echo '
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
		?>
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
		<script src="../js/query.js"></script>
	</body>
</html>