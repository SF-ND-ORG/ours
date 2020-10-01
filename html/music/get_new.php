<?php
$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

$sql="select * from music where used=0";
$retval=mysqli_query($conn,$sql);

$row=mysqli_fetch_assoc($retval);
$sql="update music set used=1  where id=".$row['id'];
mysqli_query($conn,$sql);

$row=mysqli_fetch_assoc($retval);
echo json_encode($row);
?>
