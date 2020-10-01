<?php

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if($_SERVER["REQUEST_METHOD"]=="GET")
{
        $sql="select * from follow where qq='".$_GET['qq']."'";
        $retval=mysqli_query($conn,$sql);
        $list=[];
        while($row=mysqli_fetch_assoc($retval))$list[]=$row['name'];
    echo json_encode($list);
}

?>