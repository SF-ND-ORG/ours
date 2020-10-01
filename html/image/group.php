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

    .badge{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }
    .badge-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
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
        height:100%;
    }

    .card{
      transition:all 0.3s ease-in-out;
    }
    .card:hover{
      box-shadow: 0 0 5px 3px #ddd;
    }

    img:hover{
        box-shadow: 0 0 5px 3px #bbb;
    }
    img{
        transition:all 0.3s ease-in-out
    }
</style>

<body>

<?php require("../pack/head.php")?>

<div class='container-fluid'>
<?php require("../pack/headcard_img.php")?>

  <div class="card">
  <div class="card-body">
    <h4 class="card-title">海螺湾</h4>
    <div class="text-center">
      <div class="btn-group">
        <a href="./group.php?by=tag" class="btn btn-primary">标签</a>
        <a href="./group.php?by=name" class="btn btn-warning">同学</a>
        <a href="./group.php?by=date" class="btn btn-primary">时光</a>
        <a href="./group.php?by=class" class="btn btn-warning">班级</a>
      </div>
    </div>
  </div>
</div>

<?php
if(empty($_GET["by"]))exit();
else $by=$_GET["by"];

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if($by=="tag")$sql='select tag,count(*) as ct from img_tag group by tag order by count(*) desc';
elseif($by=="name")$sql='select name,count(*) as ct from img group by name order by count(*) desc';
elseif($by=="date")$sql="select date_format(date,'%Y-%m') as date,count(*) as ct from img group by date_format(date,'%Y-%m') order by date_format(date,'%Y-%m') desc";
elseif($by=="class")$sql="select grade,class_type,class,count(*) as ct from img group by grade,class_type,class;";
else exit();

$retval0=mysqli_query($conn,$sql);
$retval=array();

while($row=mysqli_fetch_assoc($retval0))$retval[]=$row;

?>

<div class="card">
  
  <div class="card-body">
    <div class="card-title">
      <?php
        if($by=="name")echo "<h4>一共".sizeof($retval)."位同学</h4>";
        elseif($by=="tag")echo "<h4>一共".sizeof($retval)."个标签</h4>";
        elseif($by=="date")echo "<h4>一共".sizeof($retval)."个月</h4>";
        elseif($by=="class")echo "<h4>一共".sizeof($retval)."个班</h4>";
      ?>
      
    </div>
    <?php
    
    foreach($retval as $a)
    {
      if($by=="tag")echo "<a href=./conch.php?by=tag&exact=1&key=".urlencode($a["tag"])."><h5 style='display:inline-block;margin:1%;'><span class='badge badge-pill badge-primary'>".$a["tag"]."&nbsp<span class='badge badge-pill badge-light'>".$a['ct']."</span></span></h5></a>";
      elseif($by=="name") echo "<a href=./conch.php?by=name&exact=1&key=".urlencode($a["name"])."><h5 style='display:inline-block;margin:1%;'><span class='badge badge-pill badge-primary'>".$a["name"]."&nbsp<span class='badge badge-pill badge-light'>".$a['ct']."</span></span></h5></a>";
      elseif($by=="date") echo "<a href=./conch.php?by=date&exact=0&key=".$a["date"]."><h5 style='display:inline-block;margin:1%;'><span class='badge badge-pill badge-primary'>".$a["date"]."&nbsp<span class='badge badge-pill badge-light'>".$a['ct']."</span></span></h5></a>";
      elseif($by=="class") echo "<a href=./conch.php?by=class&exact=0&key=".urlencode($a["grade"].str_replace("N","高一",$a["class_type"]).$a["class"])."><h5 style='display:inline-block;margin:1%;'><span class='badge badge-pill badge-primary'>".$a["grade"].str_replace("N","高一",$a["class_type"]).$a["class"]."&nbsp<span class='badge badge-pill badge-light'>".$a['ct']."</span></span></h5></a>";
    }
    ?>
  </div>
</div>

<div class="card">
  <div class="card-body text-center">
    <h4 class="card-title">啥都木有啦</h4>
    <a href="javascript:window.scrollTo(0,0);location.reload();"><button class="btn btn-primary">嗖~刷新！</button></a>
  </div>
</div>
</div>
</body>
</html>
