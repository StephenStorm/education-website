<?php
	require '../config/common.php';
    header("Content-type: text/html; charset=utf-8");
        $username = $_POST['username'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$password = $_POST['password'];
        $repassword = $_POST['repassword'];
        if ($username == ''){
            echo '<script>alert("请输入用户名！");history.go(-1);</script>';
            exit(0);
        }
		if ($telephone == ''){
            echo '<script>alert("请输入该用户名下注册的电话号码！");history.go(-1);</script>';
            exit(0);
        }
        if ($email == ''){
            echo '<script>alert("请输入该用户名下注册的邮箱！");history.go(-1);</script>';
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
        // $conn = new mysqli('localhost','root','','school');
		
		
		$conn=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
        if ($conn->connect_error){
            echo '数据库连接失败！';
            exit(0);
        }
		$sql0 = "select et_id from user_edu_tea where et_id = '$_POST[username]'";
        $result0 = $conn->query($sql0);
        $number0 = mysqli_num_rows($result0);
		$sql1 = "select p_id from user_parent where p_id = '$_POST[username]'";
        $result1 = $conn->query($sql1);
        $number1 = mysqli_num_rows($result1);
		if ($number0==0 && $number1==0){
			echo '<script>alert("该用户名不存在，请检查无误后输入");history.go(-1);</script>';
			exit(0);
		}
        $sql2 = "select et_id from user_edu_tea where et_id = '$_POST[username]' and tel='$_POST[telephone]' ";
        $result2 = $conn->query($sql2);
        $number2 = mysqli_num_rows($result2);
		$sql3 = "select p_id from user_parent where p_id = '$_POST[username]' and tel='$_POST[telephone]'";
        $result3 = $conn->query($sql3);
        $number3 = mysqli_num_rows($result3);
		if ($number2==0 && $number3==0){
			echo '<script>alert("电话号码错误，请检查无误后输入");history.go(-1);</script>';
			exit(0);
		}
		$sql4 = "select et_id from user_edu_tea where et_id = '$_POST[username]' and email='$_POST[email]' ";
        $result4 = $conn->query($sql4);
        $number4 = mysqli_num_rows($result4);
		$sql5 = "select p_id from user_parent where p_id = '$_POST[username]' and email='$_POST[email]'";
        $result5 = $conn->query($sql5);
        $number5 = mysqli_num_rows($result5);
		if ($number4==0 && $number5==0){
			echo '<script>alert("邮箱错误，请检查无误后输入");history.go(-1);</script>';
			exit(0);
		}
		if ($number2==1 && $number4==1) {//教师和教育机构身份确认
			$sql_insert = "update user_edu_tea set password='$_POST[password]' where et_id = '$_POST[username]' ";
            $res_insert = $conn->query($sql_insert);
                    if ($res_insert) {
                    	echo "<script>alert('修改成功！');</script>";
                        echo '<script>window.location="../login.html";</script>';
						exit(0);
                    } else {
                        echo "<script>alert('系统繁忙，请稍候！');history.go(-1);</script>";
						exit(0);
                      }
		}
        if ($number3==1 && $number5==1) {//家长身份确认
			$sql_insert = "update user_parent set password='$_POST[password]' where p_id = '$_POST[username]' ";
            $res_insert = $conn->query($sql_insert);
                    if ($res_insert) {
                        echo '<script>window.location="login.html";</script>';
						exit(0);
                    } else {
                        echo "<script>alert('系统繁忙，请稍候！');history.go(-1);</script>";
						exit(0);
                      }
		}
?>