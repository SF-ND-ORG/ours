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
    
    @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        .Rotation {
            -webkit-transform: rotate(360deg);
            animation: rotation 20s linear infinite;
            -moz-animation: rotation 20s linear infinite;
            -webkit-animation: rotation 20s linear infinite;
            -o-animation: rotation 20s linear infinite;
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

$sql="select * from music where used!=-1";
$retval=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($retval))
{
    echo "<div class='alert'>".$row['id']."#".$row['used'].$row['title']."&nbsp;&nbsp;——".$row['auth'];
    echo "<div class='btn-group'><a class='btn btn-primary 'href='./judge.php?type=0&id=".$row['id']."'>AC</a>";
    echo "<a class='btn btn-warning 'href='./judge.php?type=-2&id=".$row['id']."'>WA</a>";
    echo "<a class='btn btn-primary 'href='./judge.php?type=-1&id=".$row['id']."'>RE</a>";
    echo "<a class='btn btn-warning'href='./judge.php?type=1&id=".$row['id']."'>TLE</a>";
    echo "</div></div>";
}

?>

</div></div>

</body>
</html>
