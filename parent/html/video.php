<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title><?php echo $announce['title']; ?></title>

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
		<?php echo $announce['title']; ?>
		</div>
	</div>
	<hr>
	<?php
		echo '
		<div class="row">
			<div class="col-md-offset-3 col-md-8">
				<video src="/video/'.$announce['video_path'].'" controls="controls" id="myvideo"></video>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-8 col-md-1">
				<select name="rate" id="myrate" onchange="setRate(this)">
					<option value="0.5">0.5倍速</option>
					<option value="1" selected>1倍速</option>
					<option value="2">2倍速</option>
				</select>				
			</div>
		</div>
		';
	?>
	<hr>
	<div class="row">
		<div class="col-md-offset-2 col-md-8 h2">
		<?php echo $announce['content']; ?>
		</div>
	</div>
	
</div>				
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script> -->
		<script src="../js/jquery-3.3.1.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
		<script>
			function setRate(self){
				document.getElementById("myvideo").playbackRate=self.value;
			}
		</script>
	</body>
</html>