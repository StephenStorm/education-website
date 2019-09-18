<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>课程信息</title>
<link rel="stylesheet" href="../css/course.css">
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
		<div class="col-md-offset-5 h3">课程信息</div>
	</div>
	<div class="row">
		<div class="col-md-1 col-md-offset-3">课程名称</div>
		<!-- <div class="col-md-1">起始日期</div>
		<div class="col-md-1">结束日期</div> -->
		<div class="col-md-1">教师</div>
		<div class="col-md-1">价格(￥/半年)</div>
		<div class="col-md-1">好评度(max=100)</div>
		<div class="col-md-5">简介</div>
	</div>
	<hr>
	<?php //展示课程表信息
	?>
	<?php
		echo '<div class="row">';
		echo '<div class="col-md-1 col-md-offset-3">'.$course['direction'].'</div>';
		// echo '<div class="col-md-1">'.$course['date_from'].'</div>';
		// echo '<div class="col-md-1">'.$course['date_to'].'</div>';
		echo '<div class="col-md-1">'.$course['teacher_name'].'</div>';
		echo '<div class="col-md-1">'.$course['fee'].'</div>';
		echo '<div class="col-md-1">'.$course['evaluation'].'</div>';
		echo '<div class="col-md-1">'.$course['content'].'</div>';
		echo '</div>';
		echo '<hr>';
		if(!$purchase){
			echo '<div class="col-md-1 col-md-offset-4">';
			echo '<input type="number" class="form-control" id="length" min="1" placeholder="半年数" value="1">';
			echo '</div>';
			echo '<div class="col-md-1">';
			echo '<button type="button" class="btn btn-default" onclick="add_cart(this)" id="'.$c_id.'">
				加入购物车
			</button>';
			echo '</div>';
			if(!$apply){
			echo '<div class="col-md-1">';
			echo '<button type="button" class="btn btn-default" onclick="apply_lis(this)" id="'.$username."_".$c_id.'">
				申请试听
			</button>';
			echo '</div>';
			}else{
				echo '<div class="col-md-1">';
				echo '<button type="button" class="btn btn-default" onclick="apply_lis(this)" id="'.$username."_".$c_id.'">
					取消试听申请
				</button>';
				echo '</div>';
			}
		}else{
			//评价
				echo '<div class="row">';
				echo '<div class="col-md-offset-5 h3">评价课程</div>';
				echo '</div>';
				echo '<div class="row">';
				echo '<form class="form-horizontal" method="post" action="./eva_course.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="score1" class="col-md-1 col-md-offset-3 control-label">打分</label>
    <div class="col-md-1">
      <input type="number" class="form-control" name="score" id="score1" placeholder="score" min="1" max="100">
    </div>
  </div>
  <div class="form-group">
    <label for="file1" class="col-md-1 col-md-offset-3 control-label">图片文件</label>
    <div class="col-md-3">
      <input type="file" name="file" id="file1">
    <p class="help-block">请选择图片文件.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="text1" class="col-md-1 col-md-offset-3 control-label">评价</label>
    <div class="col-md-5">
	  <textarea name="text" class="form-control" rows="5" cols="10" id="text1"></textarea>
    </div>
  </div>
  <div class="pingfen1">
  	<label  class=" control-label col-md-1 col-md-offset-3">星级评价</label>
  	<div class="content1">
  		<div class="stars1">
  			<span></span>
  			<span></span>
  			<span></span>
  			<span></span>
  			<span></span>
  		</div>
  		<div class="info1">优秀</div>
  	</div>
  </div>
  <input type="number" id="star_level1" name="star_level" value="0" hidden>
  <input type="text" value="'.$course['c_id'].'" name="c_id" hidden>
  <div class="form-group">
    <div class="col-md-offset-7 col-md-1">
      <button type="submit" class="btn btn-default">保存</button>
    </div>
		<div class=" col-md-1">
		  <a href="./delete_evaluate_course.php?c_id='.$course['c_id'].'" class="btn btn-default">删除</a>
		</div>
  </div>
</form>';
				echo '</div>';
				echo '<div class="row">';
				echo '<div class="col-md-offset-5 h3">评价开课机构</div>';
				echo '</div>';
				echo '<div class="row">';
				echo '<form class="form-horizontal" method="post" action="./eva_edu.php" enctype="multipart/form-data">
				  <div class="form-group">
				    <label for="score2" class="col-md-1 col-md-offset-3 control-label">打分</label>
				    <div class="col-md-1">
				      <input type="number" class="form-control" id="score2" name="score" placeholder="score" min="1" max="100">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="file2" class="col-md-1 col-md-offset-3 control-label">图片文件</label>
				    <div class="col-md-3">
				      <input type="file" id="file2" name="file">
				    <p class="help-block">请选择图片文件.</p>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="text2" class="col-md-1 col-md-offset-3 control-label">评价</label>
				    <div class="col-md-5">
					  <textarea name="text" class="form-control" rows="5" cols="10" id="text2"></textarea>
				    </div>
				  </div>
				  
				  <div class="pingfen2">
				  	<label  class=" control-label col-md-1 col-md-offset-3">星级评价</label>
				  	<div class="content2">
				  		<div class="stars2">
				  			<span></span>
				  			<span></span>
				  			<span></span>
				  			<span></span>
				  			<span></span>
				  		</div>
				  		<div class="info2">优秀</div>
				  	</div>
				  </div>
				    <input type="number" id="star_level2" name="star_level" value="0" hidden>
				  <input type="text" value="'.$course['et_id'].'" name="et_id" hidden>
				  <input type="text" value="'.$course['c_id'].'" name="c_id" hidden>
				  <div class="form-group">
				    <div class="col-md-offset-7 col-md-1">
				     <button type="submit" class="btn btn-default">保存</button>
				    </div>
						<div class=" col-md-1">
						  <a href="./delete_evaluate_edu.php?et_id='.$course['et_id'].'&c_id='.$course['c_id'].'" class="btn btn-default">删除</a>
						</div>
				  </div>
				</form>';
				echo '</div>';
		}
		//课程评价信息展示
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
				<div class="col-md-3"><img alt="评价人没有提供图片" width="70" src="/parent/image/course/'.$evaluation['image'].'" /></div>
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
		<script src="../js/course.js"></script>
	</body>
</html>