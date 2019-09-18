<html>
<body>

<form action="videoDir.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
	    <label for="firstname" class="col-sm-2 control-label">题目</label>
 	    <div class="col-sm-10">
    	    <input type="text" class="form-control" name="title" placeholder="请输入标题">
      	</div>
   </div>
   <div class="form-group">
	    <label for="firstname" class="col-sm-2 control-label">简介</label>
 	    <div class="col-sm-10">
    	    <input type="text" class="form-control" name="jianjie" placeholder="请输入标题">
      	</div>
   </div>

<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>

