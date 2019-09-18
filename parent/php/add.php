<?php 
$str=<<<EEE


EEE;
echo $str;

		echo '<div class="col-md-1">';
		echo '<input type="text" class="form-control" id="new_name"  placeholder="孩子姓名">';
		echo '</div>';
		
		echo '<div class="col-md-2">';
		echo '<input type="date" class="form-control info " id="new_birth"  placeholder="出生年月">';
		echo '</div>';
		
		echo '<div class="col-md-1">';
		echo '<select class="form-control info " id="new_sex">
				<option value="0">男</option>
				<option value="1">女</option>
			</select>';
		echo '</div>';
		
		echo '<div class="col-md-1">';
		echo '<input type="text" class="form-control info " id="new_direction" placeholder="课程方向" >';
		echo '</div>';
		
		echo '<div class="col-md-2">';
		echo '<div class="row">';
		echo '<div class="col-md-5">';
		echo '<input type="number" class="form-control info " id="new_fee_from" placeholder="最低" >';
		echo '</div>';
		echo '<span class="col-md-1">-</span>';
		echo '<div class="col-md-5">';
		echo '<input type="number" class="form-control info " id="new_fee_to" placeholder="最高" >';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
		echo '<div class="col-md-4">';
		echo '<div class="row">';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info" id="new_province" placeholder="省">';
		echo '</div>';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info" id="new_city" placeholder="市" >';
		echo '</div>';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info" id="new_district" placeholder="区/县" >';
		echo '</div>';
		echo '<div class="col-md-3">';
		echo '<input type="text" class="form-control info" id="new_other" placeholder="详细信息" >';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="col-md-1"><div class="row">';
		echo '<button type="button" class="btn btn-default col-md-6" onclick="remove(this)" id="new_delete">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default col-md-6" onclick="save_new(this)" id="new_add">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		</button>';
		echo '</div></div>';

?>