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
    .btn-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
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
    .card{
      transition:all 0.3s ease-in-out;
    }
    .card:hover{
      box-shadow: 0 0 5px 3px #ddd;
    }
</style>

<body>

<?php require("../pack/head.php")?>

<?php
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

    $sql='select * from atc where id='.$_GET["id"];
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
    <div class="card-body">
        <h1><?php echo $row['title']?></h1>
        <hr>
        <h6 class="text-right">
            ———
            <?php
            echo $row["grade"]."届".($row["class_type"]=="N"?"高一":$row["class_type"]).$row["class"]."班&nbsp&nbsp";
            if($row["name_type"]=='0')echo $row['name'];
            elseif($row["name_type"]=='1')echo $row["penname"]."(".$row["name"].")";
            else echo $row["penname"];
            ?>
        </h6>
        <h6 class="text-right" style="color:#888;font-size:70%;">
            <?php
            echo $row["date"]."&nbsp"."编号:".$row["id"];
            ?>
        </h6>
        <hr>
        <p <?php if($row["atc_type"]=="a")echo "class='text-center'"?>>
        <?php echo str_replace("\r\n","<br><br>",$row["atc"]);?>
        </p>
        <hr>
        <h6 class="text-right" style="color:#666">全文字数:<?php echo $row["size"]?></h6>
    </div>
</div>
<br>

<div class="card">
    <div class="card-body">
        <?php
        if($row["noshow"]=="0")
        {
        echo "<div class='alert'>&nbspQ&nbspQ&nbsp：".$row["qq"]."</div>";
        echo "<div class='alert'>电话：".$row["tel"]."</div>";
        }
        ?>
        <div class="alert">标签：
            <?php
            $tags=explode("\r\n",$row["tag"]);
            foreach($tags as $a)
            {
                if($a=='')continue;
                echo "<a href=./conch.php?by=tag&exact=1&key=".$a."><span class='badge badge-pill badge-dark'>".$a."</span></a>&nbsp";
            }
            ?>
        </div>
    </div>
</div>
<br>

<?php
$url="https://su-ours.oss-cn-hangzhou.aliyuncs.com/img/";

if(!empty($row["link"]))
{
$ct=0;
$sql='select * from img where 0';
foreach(explode("\r\n",$row["link"]) as $i)
{
    if($i=='')continue;
    $ct++;
    $sql.=" || id=".$i;
}

if($ct!=0)
{
    echo "<div class='card text-center'><div class='card-body'><h2>[link]</h2><hr>";
    $retval0=mysqli_query($conn,$sql);
    while($row0=mysqli_fetch_assoc($retval0))
    {
    if($row0['class_type']=='N')$row0['class_type']="高一";
    echo "<a href=".$url.$row0["id"].".".$row0["file_type"].(($row0["file_type"]=="GIF" || $row0["file_type"]=="gif")?"":"!low")." target='_blank'>";
    echo "<img class='card-img-top' src=".$url.$row0["id"].".".$row0["file_type"].(($row0["file_type"]=="GIF" || $row0["file_type"]=="gif")?"":"!low")." alt='qwq'>";
    echo "</a><div class='card-body'>";
    echo "<h2 class='card-title'>".$row0["title"]."</h2>";
    echo "<p style='line-height:10%'>".$row0["grade"]."届".$row0["class_type"].$row0["class"]."班  ".$row0["name"]."</p>";
    echo "<h6>".substr($row0['date'],0,10)."</h6>";
    echo "<a href=../image/show.php?id=".$row0["id"]." class='btn btn-primary'>详情</a>";
    echo "</div><hr>";
    }
    echo "</div></div>";
}


}
?>

<div class="card">
    <div class="card-body" style="text-align:center;">
        <div class="btn-group text-center">
            <button class="btn btn-success">我们没用</button>
            <button class="btn btn-warning">但是这样</button>
            <button class="btn btn-danger">比较好看</button>
        </div>
    </div>
</div>

</div>
<br>

</body>
</html>
