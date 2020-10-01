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
        src: url(https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf)
    }
    .btn:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
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
$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

$sql='select * from img_tmp';
$retval=mysqli_query($conn,$sql);

echo "<div class='container-fluid'>";
while($row=mysqli_fetch_assoc($retval))
{
    echo "<a class='btn btn-light btn-block' href=./show.php?id=".$row["id"].">";
    echo $row["id"]."-".$row["title"]."-".$row["name"];
    echo "</a>";
}
echo "</div>";

echo '<div class="container-fluid">';
echo '<div class="card">';
echo '<div class="card-body text-center">';
echo '<h4 class="card-title">啥都木有啦</h4>';
echo '<a href="javascript:window.scrollTo(0,0);location.reload();"><button class="btn btn-primary">嗖~刷新！</button></a>';
echo '</div>';
echo '</div>';
echo '</div>';
?>

</body>
</html>