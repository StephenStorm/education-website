<?php
session_start();
$link = new mysqli('localhost:3306','root','971016','tutoring_intermediary');
    if($link->connect_errno){   
        exit();
    }

if ($_FILES["file"]["type"] == "video/mp4")
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    if (file_exists("../video/" . $_FILES["file"]["name"]))
      {
       echo "<script>alert('视频已存在');location.href='first_page.html';</script>";
			
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],"../video/" . $_FILES["file"]["name"]);
      $Dir = $_FILES["file"]["name"];
      $title = $_POST['title'];
      $content = $_POST['jianjie'];
      $datetime = date("Y-m-d G:i:s");
      $sql = "insert into video values ('$_SESSION[username]','$Dir','$title','$content','$datetime') ";
      $row = $link->query( $sql );
    
    if( $row ){
        echo "<script>alert('视频保存成功');location.href='first_page.html';</script>";
    }else{
        echo "<script>alert('视频保存失败');location.href='first_page.html';</script>";
    }
    $link->close();
      }
    }
  }
else
  {
  echo "文件上传失败";
  }
?>