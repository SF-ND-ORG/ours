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

<div class='container-fluid'>
<?php
require("../pack/headcard_img.php");
?>

<?php
$url="https://su-ours.oss-cn-hangzhou.aliyuncs.com/img/";

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

$sql="select * from img where tag like '%\r\n".$gametag."\r\n%' order by rand() limit 20";
$retval0=mysqli_query($conn,$sql);
$retval=array();

while($row=mysqli_fetch_assoc($retval0))
{
  $sql="select * from zan where id =".$row['id'];
  $retval2=mysqli_query($conn,$sql);
  $row2=mysqli_fetch_assoc($retval2);
  if(empty($row2))$row['zan']=0;
  else $row['zan']=$row2['zan'];
  $retval[]=$row;
}

$ct=sizeof($retval)-1;
if($ct>=0)$mid=intdiv($ct,2);
else $mid=-1;


echo "<div class='row'><div class='col-md-6'>";
for($i=0;$i<=$mid;$i++)
{
  if($retval[$i]['class_type']=='N')$retval[$i]['class_type']="高一";
  echo "<div class='card text-center'>";
  echo "<a href=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." target='_blank'>";
  echo "<img class='card-img-top' src=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." alt='qwq'>";
  echo "</a><div class='card-body'>";
  echo "<h2 class='card-title'>".$retval[$i]["title"]."</h2>";
  echo "<p style='line-height:10%'>".$retval[$i]["grade"]."届".$retval[$i]["class_type"].$retval[$i]["class"]."班  ".$retval[$i]["name"]."</p>";
  echo "<h6>".substr($retval[$i]['date'],0,10)."</h6>";
  echo "<div class='btn-group'><a href=./show.php?id=".$retval[$i]["id"]." class='btn btn-primary'>详情</a>";
  echo "</div></div></div>";
}
echo "</div>";

echo "<div class='col-md-6'>";
for($i=$mid+1;$i<=$ct;$i++)
{
  if($retval[$i]['class_type']=='N')$retval[$i]['class_type']="高一";
  echo "<div class='card text-center'>";
  echo "<a href=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." target='_blank'>";
  echo "<img class='card-img-top' src=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." alt='qwq'>";
  echo "</a><div class='card-body'>";
  echo "<h2 class='card-title'>".$retval[$i]["title"]."</h2>";
  echo "<p style='line-height:10%'>".$retval[$i]["grade"]."届".$retval[$i]["class_type"].$retval[$i]["class"]."班  ".$retval[$i]["name"]."</p>";
  echo "<h6>".substr($retval[$i]['date'],0,10)."</h6>";
  echo "<div class='btn-group'><a href=./show.php?id=".$retval[$i]["id"]." class='btn btn-primary'>详情</a>";
  echo "</div></div></div>";
}
echo "</div></div>";

?>


<div class="card">
  <div class="card-body text-center">
    <h4 class="card-title">啥都木有啦</h4>
    <a href="javascript:window.scrollTo(0,0);location.reload();"><button class="btn btn-primary">嗖~刷新！</button></a>
  </div>
</div>
</div>

</body>
</html>
