<?php
	require '../config/common.php';
    header("Content-type: text/html; charset=utf-8");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $edu_area = $_POST['edu_area'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$address3 = $_POST['address3'];
		$address4 = $_POST['address4'];
		$allow_age_from = $_POST['allow_age_from'];
		$allow_age_to = $_POST['allow_age_to'];
		$introducation = $_POST['introducation'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$identification = $_POST['identification'];
		
        if ($username == ''){
            echo '<script>alert("请输入用户名！");history.go(-1);</script>';
            exit(0);
        }
        if ($password == ''){
            echo '<script>alert("请输入密码");history.go(-1);</script>';
            exit(0);
        }
        if ($password != $repassword){
            echo '<script>alert("密码与确认密码应该一致");history.go(-1);</script>';
            exit(0);
        }
		if ($edu_area == ''){
            echo '<script>alert("请输入教育领域！");history.go(-1);</script>';
            exit(0);
        }
		if ($address1 == '' || $address2 == '' || $address3 == '' || $address4 == ''){
            echo '<script>alert("请输入店面地址！");history.go(-1);</script>';
            exit(0);
        }
		if ($allow_age_from == ''){
            echo '<script>alert("请输入教育适合的最小年龄！");history.go(-1);</script>';
            exit(0);
        }
		if ($allow_age_to == ''){
            echo '<script>alert("请输入教育适合的最大年龄！");history.go(-1);</script>';
            exit(0);
        }
		if ($introducation == ''){
            echo '<script>alert("请输入简介！");history.go(-1);</script>';
            exit(0);
        }
		if ($telephone == ''){
            echo '<script>alert("请输入电话号码！");history.go(-1);</script>';
            exit(0);
        }
        if ($email == ''){
            echo '<script>alert("请输入邮箱！");history.go(-1);</script>';
            exit(0);
        }
        if ($identification == ''){
            echo '<script>alert("请输入标识码 ！");history.go(-1);</script>';
            exit(0);
        }
		if(is_int($allow_age_from)){
			echo '<script>alert("您输入的最小年龄不正确，请重新输入整数！");history.go(-1);</script>';
			exit(0);
		}
		if(is_int($allow_age_to)){
			echo '<script>alert("您输入的最大年龄不正确，请重新输入整数！");history.go(-1);</script>';
			exit(0);
		}
		if($allow_age_from>$allow_age_to || $allow_age_from>200 || $allow_age_from<0 ||$allow_age_to>200 ||$allow_age_to<0){
			echo '<script>alert("教育适合年龄输入错误，请认真检查后输入！");history.go(-1);</script>';
			exit(0);
		}
		function is_mobile($text){
			$search='/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
			if(preg_match($search, $text)){
				return (true);
			} else {
				return(false);
			}
		}
		if(is_mobile($telephone)==false){
			echo '<script>alert("您输入的电话号码不正确，请重新输入！");history.go(-1);</script>';
			exit(0);
		}
$change=false;
        if($password == $repassword ){
            $conn=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
            if ($conn->connect_error){
				$change =true;
                echo '数据库连接失败！';
                exit(0);
            }else {
                $sql0 = "select et_id from user_edu_tea where et_id = '$_POST[username]'";
                $result0 = $conn->query($sql0);
                $number0 = mysqli_num_rows($result0);
				$sql1 = "select p_id from user_parent where p_id = '$_POST[username]'";
                $result1 = $conn->query($sql1);
                $number1 = mysqli_num_rows($result1);
				$sql2 = "select a_id from user_admin where a_id = '$_POST[username]'";
                $result2 = $conn->query($sql2);
                $number2 = mysqli_num_rows($result2);
				$sql3 = "select tel from user_edu_tea where tel = '$_POST[telephone]' and role=0";
                $result3 = $conn->query($sql3);
                $number3 = mysqli_num_rows($result3);
				$sql4 = "select email from user_edu_tea where email = '$_POST[email]' and role =0";
                $result4 = $conn->query($sql4);
                $number4 = mysqli_num_rows($result4);
                if ($number0 || $number1 || $number2) {
                    echo '<script>alert("该用户名已经存在");history.go(-1);</script>';
					exit(0);
                } else {
                	if ($number3!=0) {
					    //echo '<script>alert("该电话号码已被注册！");history.go(-1);</script>';
					    exit(0);
				    }
				    if ($number4!=0) {
					    echo '<script>alert("该邮箱已被注册！");history.go(-1);</script>';
					    exit(0);
				    }
                    $sql_insert = "insert into user_edu_tea (et_id,password,identify,role,tel,email,age_from,age_to,area,intro,state) values('$_POST[username]','$_POST[password]','$_POST[identification]','0','$_POST[telephone]','$_POST[email]','$_POST[allow_age_from]','$_POST[allow_age_to]','$_POST[edu_area]','$_POST[introducation]',0)";
                   $res_insert = $conn->query($sql_insert);
					$sql_insert1 = "insert into edu_store (et_id,province,city,district,other) values('$_POST[username]','$_POST[address1]','$_POST[address2]','$_POST[address3]','$_POST[address4]')";
                   $res_insert1 = $conn->query($sql_insert1);
                    if ($res_insert and $res_insert1) {
                        echo '<script>window.location="../login.html";</script>';
						exit(0);
                    } else {
						if(!$res_insert && !$res_insert1)
							// if($change)
								// echo "<script>alert('系统繁忙，请稍候！');history.go(-1);</script>";
								// echo $sql_insert."<br/>".$sql_insert1;
						header("location:/login.html");
						exit(0);
                    }
                }
            }
        }else{
            echo "<script>alert('提交未成功！'); history.go(-1);</script>";
			exit(0);
        }
?>