<?php

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $s=$_GET['list'];
    $s=str_replace("\r\n","\n",$s);
    $list=explode("\n",$s);
    foreach($list as $i)
    {
        if($i=='')continue;
        $sql="insert into follow (qq,name)VALUES('".
            $_GET['qq']."','".$i."')";
        mysqli_query($conn,$sql);
    }
    echo 1;
}

?>