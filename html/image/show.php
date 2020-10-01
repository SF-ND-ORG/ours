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
        font-family: fz;
        src: url('https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf');
    }
    .btn-success:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-warning:hover{
      background-color: #fd3;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-danger:hover{
        background-color: #f8b;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    .badge-dark:hover{
        background-color: #def;
        color:#000;
    }
    .badge{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    .navbar-brand:hover{
      transition:all 0.5s ease-in-out;
      text-shadow: 0px 0px 5px  #fee;
    }

    [aria-expanded=true]{
      border-color: #f99 !important;
    }

    body{
        font-family: fz;
    }
    
    img:hover{
        box-shadow: 0 0 5px 3px #bbb;
    }
    img{
        transition:all 0.3s ease-in-out
    }
    .alert{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }
    .alert:hover{
        color:#369;
        background-color: #adf;
        box-shadow: 0 0 5px 3px #ddd;
    }
</style>

<body>

<?php require("../pack/head.php")?>

<?php
$url="https://su-ours.oss-cn-hangzhou.aliyuncs.com/img/";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(empty($_GET["id"]))
    {
        echo '<div class="container-fluid">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h4 class="card-title text-center">啥都木有哟</h4>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        exit();
    }

    $dbhost="localhost:3306";
    $dbuser="root";
    $dbpass="PASSWORD";
    $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
    mysqli_query($conn,"set names utf8");
    mysqli_select_db($conn,'ours');

    $sql='select * from img where id='.$_GET["id"];
    $retval=mysqli_query($conn,$sql);

    /*
    if(mysql_num_rows($retval)==0)
    {
        
    }*/
    $row=mysqli_fetch_assoc($retval);
    if($row==false)
    {
        echo '<div class="container-fluid">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h4 class="card-title text-center">啥都木有哟</h4>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        exit();
    }
}
?>

<div class="container-fluid">
<div class="card">
        <a href=<?php echo $url.$row['id'].'.'.$row['file_type'];?> target="_blank">
            <img class="card-img-top" src=<?php echo $url.$row['id'].'.'.$row['file_type'];?> alt="Card image">
        </a>
        
        <div class="card-body">
            <h2 class="text-center">〔<?php echo $row['title']?>〕</h2>
            <div class="alert alert-info">编号：<?php echo $row["id"];?></div>
            <div class="alert alert-info">时间：<?php echo $row["date"];?></div>
            <div class="alert alert-info">姓名：<?php echo $row["name"];?></div>
            <div class="alert alert-info">班级：<?php echo $row["grade"]."届".($row["class_type"]!="N"?$row["class_type"]:"高一").$row["class"]."班";?></div>
            <?php
            if($row["noshow"]=="0")
            {
            echo "<div class='alert alert-info'>&nbspQ&nbspQ&nbsp：".$row["qq"]."</div>";
            echo "<div class='alert alert-info'>电话：".$row["tel"]."</div>";
            }
            ?>
            <div class="alert alert-info">标签：
                <?php
                $tags=explode("\r\n",$row["tag"]);
                foreach($tags as $a)
                {
                    if($a=='')continue;
                    echo "<a href=./conch.php?by=tag&exact=1&key=".$a."><span class='badge badge-pill badge-dark'>".$a."</span></a>&nbsp";
                }
                ?>
            </div>
            <div style="text-align:center;">
                <div class="btn-group text-center">
                    <button class="btn btn-success">我们没用</button>
                    <button class="btn btn-warning">但是这样</button>
                    <button class="btn btn-danger">比较好看</button>
                </div>
            </div>
        </div>
      </div>
</div>
<br>

</body>
</html>