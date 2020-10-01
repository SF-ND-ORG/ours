<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>

<?php

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET["type"]) && !empty($_GET["id"]))
{
    $dbhost="localhost:3306";
    $dbuser="root";
    $dbpass="PASSWORD";
    $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
    mysqli_query($conn,"set names utf8");
    mysqli_select_db($conn,'ours');

    $sql='select * from atc_tmp where tmp_id='.$_GET["id"];
    $retval=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($retval);
    if($_GET["type"]=="ins")
    {
        //删除临时数据库
        $sql='insert into atc_rbs select * from atc_tmp where tmp_id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
        $sql='delete from atc_tmp where tmp_id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
        
		echo "DONE delete<br>";
        
        
        //加入tag数据库
        $tag=explode("\r\n",$row["tag"]);
        foreach($tag as $a)
        {
            if($a!="")
            {
                $a=addslashes($a);
                $sql="insert into atc_tag".
                    "(tag)".
                    "VALUES".
                    "('".$a."')";
                $retval=mysqli_query($conn,$sql);
            }
        }
		
        echo "DONE add tag<br>";
		

        //加入正式数据库
        $row['title']=addslashes($row['title']);
        $row['tag']=addslashes($row['tag']);
        $row['atc']=addslashes($row['atc']);
        $row['penname']=addslashes($row['penname']);
        $sql="insert into atc".
            "(tmp_id,name,penname,grade,class_type,class,qq,tel,title,name_type,noshow,tag,link,date,atc_type,atc,size,mail)".
            "VALUES".
            "(".$row['tmp_id'].",'".$row['name']."','".$row['penname']."','".$row['grade']."','".$row['class_type']."',".
            $row['class'].",'".$row['qq']."','".$row['tel']."','".$row['title']."',".$row['name_type'].",".
            $row['noshow'].",'".$row['tag']."','".$row['link']."','".$row['date'].
            "','".$row['atc_type']."','".$row['atc']."',".$row['size'].",'".$row['mail']."')";
        $retval=mysqli_query($conn,$sql);

        $sql="select last_insert_id()";
        $retval0=mysqli_query($conn,$sql);
        $row0=mysqli_fetch_assoc($retval0);
        $last_num=$row0['last_insert_id()'];

        //加入link数据库
        $link=explode("\r\n",$row["link"]);
        foreach($link as $a)
        {
            if($a!="")
            {
                $sql="insert into link".
                    "(img,atc)".
                    "VALUES".
                    "(".$a.",".$last_num.")";
                $retval=mysqli_query($conn,$sql);
            }
        }
    }
    elseif($_GET["type"]=="del")
    {
        $sql='insert into atc_rbs select * from atc_tmp where tmp_id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
        $sql='delete from atc_tmp where tmp_id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
    }

    echo "DONE all";

    $name=$row["name"];
    $id=$row["tmp_id"];
    $title=$row["title"];
    $to=$row["mail"];
    $status=($_GET["type"]=='ins'?'1':'0');

    $url='http://localhost:5700/send_private_msg?user_id='.$row['qq'].'&message=【Ours】'.$name.'!~你的文章['.$title."](id:".$id.')'.($status==1?"审核通过啦！":"被退回了哟，请更改后再上传。");
    echo $url;

    echo file_get_contents($url);
    
    if($row["mail"]=="")echo "<script>window.location.href = './';</script>";
    else
    {
        echo "<script>window.location.href = './mail/send.php?id=$id&name=$name&title=$title&status=$status&to=$to';</script>";
    }
}
?>



</html>