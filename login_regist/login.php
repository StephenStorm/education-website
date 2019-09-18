<?php
    session_start();
	require '../config/common.php';
	$conn=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
    header("Content-type: text/html; charset=utf-8");
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($conn->connect_error){
        echo '数据库连接失败！';
        exit(0);
    }else{
        if ($username == ''){
            echo '<script>alert("请输入用户名！");history.go(-1);</script>';
            exit(0);
        }
        if ($password == ''){
            echo '<script>alert("请输入密码！");history.go(-1);</script>';
            exit(0);
        }
        $sql0= "select et_id from user_edu_tea where et_id = '$_POST[username]' and role = '0'";//教育机构ID查询
        $result0 = $conn->query($sql0);
        $number0 = mysqli_num_rows($result0);
        $sql00= "select password,et_id from user_edu_tea where password = '$_POST[password]' and et_id = '$_POST[username]' and role = '0'";
        $result00 = $conn->query($sql00);
        $number00 = mysqli_num_rows($result00);
        if ($number0==1 && $number00==0) {
        	echo '<script>alert("密码错误！");history.go(-1);</script>';
			exit(0);
        }
        $sql1= "select p_id from user_parent where p_id = '$_POST[username]' ";//家长ID查询
        $result1 = $conn->query($sql1);
        $number1 = mysqli_num_rows($result1);
        $sql11= "select p_id from user_parent where p_id = '$_POST[username]' and password = '$_POST[password]'";
        $result11 = $conn->query($sql11);
        $number11 = mysqli_num_rows($result11);
        if ($number1==1 && $number11==0) {
        	echo '<script>alert("密码错误！");history.go(-1);</script>';
			exit(0);
        }
        $sql2= "select a_id from user_admin where a_id = '$_POST[username]'";//系统管理员ID查询
        $result2 = $conn->query($sql2);
        $number2 = mysqli_num_rows($result2);
        $sql22= "select a_id,password from user_admin where a_id = '$_POST[username]' and password = '$_POST[password]'";
        $result22 = $conn->query($sql22);
        $number22 = mysqli_num_rows($result22);
        if ($number2==1 && $number22==0) {
        	echo '<script>alert("密码错误！");history.go(-1);</script>';
			exit(0);
        }
        $sql3= "select et_id from user_edu_tea where et_id = '$_POST[username]' and role = '1'";//教师ID查询
        $result3 = $conn->query($sql3);
        $number3 = mysqli_num_rows($result3);
        $sql33= "select password,et_id from user_edu_tea where password = '$_POST[password]' and et_id = '$_POST[username]' and role = '1'";
        $result33 = $conn->query($sql33);
        $number33 = mysqli_num_rows($result33);
        if ($number3==1 && $number33==0) {
        	echo '<script>alert("密码错误！");history.go(-1);</script>';
			exit(0);
        }
        if ($number0 == 0 && $number1 == 0 && $number2 == 0 && $number3==0) {
           echo '<script>alert("用户名不存在！");history.go(-1);</script>';
		   exit(0);
        }
        $sql4= "select et_id from user_edu_tea where et_id = '$_POST[username]' and state = 1";//教育机构审核通过
        $result4 = $conn->query($sql4);
        $number4 = mysqli_num_rows($result4);
        if ($number00==1 && $number4==1) {//教育机构审核通过后登录
		    $_SESSION['userid']=$username;
            echo '<script>window.location="../stephen/edumessage.php";</script>';
			exit(0);
        }
        $sql5= "select et_id from user_edu_tea where et_id = '$_POST[username]' and state = 2";//教育机构审核未通过
        $result5 = $conn->query($sql5);
        $number5 = mysqli_num_rows($result5);
        if ($number00==1 && $number5==1) {//教育机构审核未通过
        	echo '<script>alert("您的教育机构注册审核未通过！");history.go(-1);</script>';
		    exit(0);
        }
        if ($number00==1 && $number4==0 && $number5==0) {//教育机构正在审核中
        	echo '<script>alert("您的教育机构注册正在审核中！");history.go(-1);</script>';
		    exit(0);
        }
        if ($number11==1) {//家长
        	session_start();
		    $_SESSION['username']=$username;
            header("location:/parent/php/index.php");
			exit(0);
        } 
        if ($number22==1) {//系统管理员
		    $_SESSION['username']=$username;
            echo '<script>window.location="/Web/first_page.html";</script>';
			exit(0);
        } 
        $sql6= "select et_id from user_edu_tea where et_id = '$_POST[username]' and state=1";//教师审核通过
        $result6 = $conn->query($sql6);
        $number6 = mysqli_num_rows($result6);
        if ($number33==1 && $number6==1) {//教师登录
		    $_SESSION['userid']=$username;
            echo '<script>window.location="../stephen/teacherChange.php";</script>';
			exit(0);
        } 
        $sql7= "select et_id from user_edu_tea where et_id = '$_POST[username]' and state=2";//教师未审核通过
        $result7 = $conn->query($sql7);
        $number7 = mysqli_num_rows($result7);
        if ($number33==1 && $number7==1) {//教师审核未通过
        	echo '<script>alert("您的教师注册审核未通过！");history.go(-1);</script>';
		    exit(0);
        }
        if ($number33==1 && $number7==0 && $number6==0) {//教师正在审核中
        	echo '<script>alert("您的教师注册正在审核中！");history.go(-1);</script>';
		    exit(0);
        }
    }
?>