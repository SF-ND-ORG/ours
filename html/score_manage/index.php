<!DOCTYPE html>
<html>
<head>
  <title>SU-Ours</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<style>
    @font-face {
        font-family: 'fz';
        src: url('https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf');
    }
    .btn-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-warning:hover{
        background-color: #fd3;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    .img:hover{
        box-shadow: 0 0 10px 10px #fdd;
    }
    img{
        border-radius: 50%;
        transition:all 0.3s ease-in-out;
        box-shadow:0 0 5px 3px #bbb;
    }

    .navbar-brand:hover{
      transition:all 0.5s ease-in-out;
      text-shadow: 0px 0px 5px  #fee;
    }

    [aria-expanded=true]{
      border-color: #f99 !important;
    }

    .alert{
        outline:none;
        border:none;
        background-color:#fee;
        transition:all 0.5s ease-in-out;
    }
    .alert:hover{
        color:#369;
        background-color: #adf;
        box-shadow: 0 0 5px 3px #ddd;
    }

    body{
        font-family: 'fz';
    }
</style>

<body>

<?php require("../pack/head.php")?>


<div class="alert">
<h1>一个究极<del>无聊</del>的辅助工具</h1>
<h2>工作愉快！辛苦了(๑و•̀ω•́)و </h2>
</div>
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="file" /> 
<hr>
<input type="submit" name="submit" value="Submit" />
</form>

<?php
if(!empty($_FILES['file']))
{
    
    //if($_FILES['file']['type']!='text/csv' || $_FILES['file']['type']!=)exit();
    echo $_FILES['file']['tmp_name'];
    move_uploaded_file($_FILES['file']['tmp_name'],"./tmp.csv");
    system("cp tmp.csv ".$_FILES['file']['name']);
    $r=system("python3 ./trans.py");
    echo var_dump($r);
    system("cp result.json ".explode('.',$_FILES['file']['name'])[0].".json");
    echo "<hr>已经收到".$_FILES['file']['name']."<br><a class='btn btn-primary' href='./result.json'>查看</a><br>";
    echo "<textarea>"."$r"."</textarea>";

}
?>

</body>
</html>
