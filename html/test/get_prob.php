<?php
$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

$sql="select * from probpool order by rand() limit 1";
$retval=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($retval);

$list=explode("\n",$row['prob']);
$list1=array_slice($list,0,1);
$list2=array_slice($list,1,4);
shuffle($list2);
$list=array_merge($list1,$list2);
array_push($list,$row['probnum']);

echo json_encode($list);

?>
