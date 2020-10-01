<?php
$lifetime=10;

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

function zan()
{
    $sql="select * from zan where id=".$_GET['imgid'];
    $retval=mysqli_query($GLOBALS['conn'],$sql);
    $row=mysqli_fetch_assoc($retval);
    if(empty($row))
    {
        $sql="insert into zan (id,zan) VALUES (".$_GET['imgid'].",1)";
        $retval=mysqli_query($GLOBALS['conn'],$sql);
    }
    else
    {
        $sql="update zan set zan=".(string)((int)$row['zan']+1)." where id=".$_GET['imgid'];
        $retval=mysqli_query($GLOBALS['conn'],$sql);
    }
    echo "成功赞啦！";
}

if(empty($_GET['probnum']) || empty($_GET['out']) || empty($_GET['imgid']))
{
    echo "啥？";
    exit();
}


$sql="select * from probpool where probnum=".$_GET['probnum'];
$retval=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($retval);

if(empty($row))exit();


if($_GET['out']!=$row['ans'])
{
    echo "验证失败";
    exit();
}

$imgid=$_GET['imgid'];

$usr=(string)microtime(true);
if(!empty($_COOKIE))
{
    $cookie=array_keys($_COOKIE)[0];
    $cookietime=array_values($_COOKIE)[0];

    $sql="select * from zanlog where name='".$cookie."' and imgid=".$imgid;
    $retval=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($retval);
    if(empty($row))
    {
        $sql="insert into zanlog (name,imgid,time) VALUES ('".$cookie."',".$imgid.",".(time()+$lifetime).")";
        $retval=mysqli_query($conn,$sql);
    }
    else
    {
        if((int)$row['time']>time())
        {
            echo "最近已经赞过咯~";
            exit();
        }
        else
        {
            $sql="update zanlog set time=".(string)(time()+$lifetime)." where name='".$cookie."' and imgid=".$imgid;
            $retval=mysqli_query($conn,$sql);
        }
    }
}
else
{
    setcookie($usr,time()+10,time()+10);
    $sql="insert into zanlog (name,imgid,time) VALUES ('".str_replace('.','_',$usr)."',".$imgid.",".(time()+$lifetime).")";
    $retval=mysqli_query($conn,$sql);
}

$ip=$_SERVER["REMOTE_ADDR"];
$sql="select * from zanlog where name='".$ip."' and imgid=".$imgid;
$retval=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($retval);
if(empty($row))
{
    $sql="insert into zanlog (name,imgid,time) VALUES ('".$ip."',".$imgid.",".(time()+$lifetime).")";
    $retval=mysqli_query($conn,$sql);
}
else
{
    if((int)$row['time']>time())
    {
        echo "最近已经赞过咯~";
        exit();
    }
    else
    {
        $sql="update zanlog set time=".(string)(time()+$lifetime)." where name='".$ip."' and imgid=".$imgid;
        $retval=mysqli_query($conn,$sql);
    }
}

zan();
?>
