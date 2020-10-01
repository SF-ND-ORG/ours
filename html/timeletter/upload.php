<?php

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

$from_name=addslashes($_POST["from_name"]);
$from_tel=addslashes($_POST["from_tel"]);
$from_qq=addslashes($_POST["from_qq"]);
$from_mail=addslashes($_POST["from_mail"]);

$to_name=addslashes($_POST["to_name"]);
$to_tel=addslashes($_POST["to_tel"]);
$to_qq=addslashes($_POST["to_qq"]);
$to_mail=addslashes($_POST["to_mail"]);

$recvt=addslashes($_POST["recvt"]);
$atc=addslashes($_POST["atc"]);

$sql="insert into tmlt".
            "(from_name,from_qq,from_tel,from_mail,".
            "to_name,to_qq,to_tel,to_mail,status,sendt,recvt,atc)".
            "VALUES".
            "('$from_name','$from_qq','$from_tel','$from_mail',".
            "'$to_name','$to_qq','$to_tel','$to_mail',".
            "0,NOW(),'$recvt','$atc')";
        
        mysqli_query($conn,$sql);

        echo "ok"
?>