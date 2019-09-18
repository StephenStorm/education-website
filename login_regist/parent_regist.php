<?php
    session_start();
	require '../config/common.php';
    header("Content-type: text/html; charset=utf-8");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $children_name = $_POST['children_name'];
		$children_age = $_POST['children_age'];
		$children_sex = $_POST['children_sex'];
		$parent_name = $_POST['parent_name'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
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
		if ($children_name == ''){
            echo '<script>alert("请输入孩子姓名！");history.go(-1);</script>';
            exit(0);
        }
		if ($children_age == ''){
            echo '<script>alert("请输入孩子年龄！");history.go(-1);</script>';
            exit(0);
        }
		if ($children_sex == ''){
            echo '<script>alert("请输入孩子性别！");history.go(-1);</script>';
            exit(0);
        }
		if ($parent_name == ''){
            echo '<script>alert("请输入父母名字！");history.go(-1);</script>';
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
		}
		// if(is_int($children_age)|| $children_age>50 || $children_age<0){
		// 	echo '<script>alert("您的孩子年龄输入不正确，请重新输入一个整数！");history.go(-1);</script>';
		// 	exit(0);
		// }
		if($children_sex!=0 && $children_sex!=1){
			echo '<script>alert("您的孩子性别输入不正确，请重新输入！");history.go(-1);</script>';
			exit(0);
		}
        if($password == $repassword ){
            $conn=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
            if ($conn->connect_error){
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
				$sql3 = "select tel from user_parent where tel = '$_POST[telephone]'";
                $result3 = $conn->query($sql3);
                $number3 = mysqli_num_rows($result3);
				$sql4 = "select email from user_parent where email = '$_POST[email]'";
                $result4 = $conn->query($sql4);
                $number4 = mysqli_num_rows($result4);
                if ($number0 || $number1 || $number2) {
                    echo '<script>alert("该用户名已经存在");history.go(-1);</script>';
					exit(0);
                } else {
                	if ($number3!=0) {
					echo '<script>alert("该电话号码已被注册！");history.go(-1);</script>';
					exit(0);
				    }
				    if ($number4!=0) {
					echo '<script>alert("该邮箱已被注册！");history.go(-1);</script>';
					exit(0);
				    }
                    $sql_insert0 = "insert into user_parent (p_id,password,p_name,tel,email) values('$_POST[username]','$_POST[password]','$_POST[parent_name]','$_POST[telephone]','$_POST[email]')";
                    $res_insert0 = $conn->query($sql_insert0);
					$sql_insert1 = "insert into student (p_id,s_name,birth,sex) values('$_POST[username]','$_POST[children_name]','$_POST[children_age]','$_POST[children_sex]')";
                    $res_insert1 = $conn->query($sql_insert1);
                    if ($res_insert0 && $res_insert1) {
		                 $_SESSION['username']=$username;
                        header("location:/parent/php/index.php");
						exit(0);
                    } else {
                        echo "<script>alert('系统繁忙，请稍候！');history.go(-1);</script>";
						exit(0);
                    }
                }
            }
        }else{
            echo "<script>alert('提交未成功！'); history.go(-1);</script>";
			exit(0);
        }
?>