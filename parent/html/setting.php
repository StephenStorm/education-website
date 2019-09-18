<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title></title>

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
		<li><a href="/parent/php/info.php">个人信息</a></li>	
		<li><a href="./shopping_cart.php">购物车</a></li>
		<li><a href="./purchase_records.php">购物记录</a></li>		
      </ul>
	  <ul class="nav navbar-nav navbar-right">
		  <li class="active"><a href="#">设置</a></li>
		  <li><a href="./logout.php">退出</a></li>
	  </ul>
	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-5 h3">家长的信息</div>
	</div>
	<div class="row">
		<label class="col-md-1 col-md-offset-2">用户名</label>
		<label class="col-md-1">真实姓名</label>
		<label class="col-md-2">密码</label>
		<label class="col-md-2">手机号</label>
		<label class="col-md-2">Email</label>
		<label class="col-md-1">保存</label>
	</div>
	<div class="row">
		<div class="form-group col-md-1 col-md-offset-2">
			<input type="text" class="form-control" id="p_id" disabled="disabled" placeholder="用户名" value="<?php echo $username;?>">
		</div>
		<div class="form-group col-md-1">
			<input type="text" class="form-control" id="exampleInput4" readonly disabled="disabled" placeholder="真实姓名" value="<?php echo $parent['p_name'];?>">
		</div>
		<div class="form-group col-md-2">
			<input type="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $parent['password'];?>">
		</div>
		<div class="form-group col-md-2">
			<input type="tel" class="form-control" id="tel" onkeyup="validate_tel(this)" placeholder="Enter phone" value="<?php echo $parent['tel'];?>">
		</div>
		<div class="form-group col-md-2">
			<input type="email" class="form-control" id="email" onkeyup="validate_email(this)" placeholder="Enter email" value="<?php echo $parent['email'];?>">
		</div>
		<div class="col-md-1">
			<button type="button" class="btn btn-default" onclick="save_parent()">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-offset-5 h3">孩子的信息</div>
	</div>
	<div class="row">
		<label class="col-md-1">孩子姓名</label>
		<label class="col-md-2">出生年月</label>
		<label class="col-md-1">性别</label>
		<label class="col-md-1">课程方向</label>
		<label class="col-md-2">费用范围/￥</label>
		<label class="col-md-4">地区</label>
		<label class="col-md-1">修改</label>
	</div>
	<hr>
	<?php
	while($child=$childs->fetch_assoc()){
		echo '<div class="row">';
		echo '<div class="col-md-1">';
		echo '<input type="text" class="form-control" name="s_name" readonly disabled="disabled" placeholder="孩子姓名" value="'.$child['s_name'].'">';
		echo '</div>';
		
		echo '<div class="col-md-2">';
		echo '<input type="date" class="form-control info '.$child['s_name'].'" name="birth"  placeholder="出生年月" value="'.$child['birth'].'">';
		echo '</div>';
		
		$selected0=$selected1="";
		if($child['sex']==$definition['female']){
			$selected1='selected';
		}else{
			$selected0='selected';
		}
		echo '<div class="col-md-1">';
		echo '<select class="form-control info '.$child['s_name'].'" name="sex">
				<option value="'.$definition['male'].'"'.$selected0.'>男</option>
				<option value="'.$definition['female'].'"'.$selected1.'>女</option>
			</select>';
		echo '</div>';
		
		echo '<div class="col-md-1">';
		echo '<input type="text" class="form-control info '.$child['s_name'].'" name="direction" placeholder="课程方向" value="'.$child['direction'].'">';
		echo '</div>';
		
		echo '<div class="col-md-2">';
		echo '<div class="row">';
		echo '<div class="col-md-5">';
		echo '<input type="number" class="form-control info '.$child['s_name'].'" min="0" name="fee_from" placeholder="最低" value="'.$child['fee_from'].'">';
		echo '</div>';
		echo '<span class="col-md-1">-</span>';
		echo '<div class="col-md-5">';
		echo '<input type="number" class="form-control info '.$child['s_name'].'" name="fee_to" min="0" placeholder="最高" value="'.$child['fee_to'].'">';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	
		$area='';
		if(!empty($child['province'])){
			$area.=$child['province'].'省';
		}
		if(!empty($child['city'])){
			$area.=$child['city'].'市';
		}
		if(!empty($child['district'])){
			$area.=$child['district'];
		}
		if(!empty($child['other'])){
			$area.=$child['other'];
		}
		echo '<div class="col-md-4">';
		echo '<div class="row">';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info '.$child['s_name'].'" name="province" placeholder="省" value="'.$child['province'].'">';
		echo '</div>';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info '.$child['s_name'].'" name="city" placeholder="市" value="'.$child['city'].'">';
		echo '</div>';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info '.$child['s_name'].'" name="district" placeholder="区/县" value="'.$child['district'].'">';
		echo '</div>';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info '.$child['s_name'].'" name="other" placeholder="详细信息" value="'.$child['other'].'">';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="col-md-1"><div class="row">';
		echo '<button type="button" class="btn btn-default col-md-6" onclick="remove(this)" id="'.$child['s_name'].'">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default col-md-6" onclick="save(this)" id="'.$child['s_name'].'">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		</button>';
		echo '</div></div>';
		echo '</div>';
		echo '<hr>';
	}
	
	?>
	<div class="row">
		<button type="button" class="btn btn-default col-md-1 col-md-offset-5" onclick="add(this)">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
	</div>
</div>
		<div class="row" id="feedback">
			
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
		<script src="../js/setting.js"></script>
	</body>
</html>