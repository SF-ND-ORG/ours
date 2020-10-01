<?php
$lifetime=15*60;

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if($_SERVER["REQUEST_METHOD"]!="GET")exit();

$sql="select * from zanlog where name='".$_GET['user_id']."'";
$retval=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($retval);

if(!empty($row))
{
        if((int)$row['time']>time())
        {
                echo "每一刻钟，点一次，哦！\n不如先来体育节摄影大赛康康？";
                exit();
        }
        $sql="update zanlog set time=".(time()+$lifetime)." where name='".$_GET['user_id']."'";
        $retval=mysqli_query($conn,$sql);
}
else
{
        $sql="insert into zanlog (name,time)VALUES('".$_GET['user_id']."',".(time()+$lifetime).")";
        $retval=mysqli_query($conn,$sql);
}

$sql="insert into music (title,auth,src,jump,img,site,qq,used,time)VALUES('" .
        $_GET['title']."','".$_GET['desc']."','".$_GET['musicUrl']."','".$_GET['jumpUrl']."','".
        $_GET['preview']."','".$_GET['tag']."','".$_GET['user_id']."',-1,NOW())";

$retval=mysqli_query($conn,$sql);

echo 1;

?>
