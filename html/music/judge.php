<?php
$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if(empty($_GET['id']))exit();

$sql="update music set used=".$_GET['type']."  where id=".$_GET['id'];
$retval=mysqli_query($conn,$sql);

echo"<script>history.go(-1);</script>"
?>
