<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>

<?php
require_once './aliyun-oss-php-sdk-2.3.0.phar';
use OSS\OssClient;
use OSS\Core\OssException;

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET["type"]) && !empty($_GET["id"]))
{
    $dbhost="localhost:3306";
    $dbuser="root";
    $dbpass="PASSWORD";
    $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
    mysqli_query($conn,"set names utf8");
    mysqli_select_db($conn,'ours');

    $sql='select * from img_tmp where id='.$_GET["id"];
    $retval=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($retval);
    if($_GET["type"]=="ins")
    {
        //删除临时数据库
        $sql='insert into img_rbs select * from img_tmp where id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
        $sql='delete from img_tmp where id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
        
		echo "DONE delete<br>";
        
        
        //加入tag数据库
        $tag=explode("\r\n",$row["tag"]);
        foreach($tag as $a)
        {
            if($a!="")
            {
                $a=addslashes($a);
                $sql="insert into img_tag".
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
        $sql="insert into img".
            "(tmp_id,name,grade,class_type,class,qq,tel,title,noshow,tag,date,file_type,height,width,size,mail)".
            "VALUES".
            "(".$row['id'].",'".$row['name']."','".$row['grade']."','".$row['class_type']."',".
            $row['class'].",'".$row['qq']."','".$row['tel']."','".$row['title'].
            "',".$row['noshow'].",'".$row['tag']."','".$row['date']."','".$row['file_type'].
            "',".$row['height'].",".$row['width'].",".$row['size'].",'".$row['mail']."')";
        $retval=mysqli_query($conn,$sql);

		echo "DONE add img<br>";
		
        //获取文件名
        $old_name=$row["id"].".".$row["file_type"];
        $sql="select last_insert_id()";
        $retval=mysqli_query($conn,$sql);
        $new_name=mysqli_fetch_assoc($retval)['last_insert_id()'].'.'.$row["file_type"];

		echo "DONE get file name<br>";
		echo "Start move "."../tmp/image/".$old_name." To ./img/".$new_name."<br>";
		
		//上传
        
		// 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
		$accessKeyId = "";
		$accessKeySecret = "";
		// Endpoint以杭州为例，其它Region请按实际情况填写。
		//$endpoint = "http://oss-cn-hangzhou.aliyuncs.com";
		$endpoint = "oss-cn-hangzhou-internal.aliyuncs.com";

		// 存储空间名称
		$bucket= "su-ours";
		// 文件名称
		$object = "img/".$new_name;
		// <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt
		$filePath = getcwd()."/../tmp/image/".$old_name;

		try{
			$ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

			$ossClient->uploadFile($bucket, $object, $filePath);
		} catch(OssException $e) {
			printf(__FUNCTION__ . ": FAILED\n");
			printf($e->getMessage() . "\n");
			return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
    }
    elseif($_GET["type"]=="del")
    {
        $sql='insert into img_rbs select * from img_tmp where id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
        $sql='delete from img_tmp where id='.$_GET["id"];
        $retval=mysqli_query($conn,$sql);
    }

    echo "DONE all";

    $name=$row["name"];
    $id=$row["id"];
    $title=$row["title"];
    $to=$row["mail"];
    $status=($_GET["type"]=='ins'?'1':'0');

    echo file_get_contents('http://localhost:5700/send_private_msg?user_id='.$row['qq'].'&message=【Ours】'.$name.'!~你的图片['.$title."](id:".$id.')'.($status==1?"审核通过啦！":"被退回了哟，请更改后再上传。"));
    
    if($row["mail"]=="")echo "<script>window.location.href = './';</script>";
    else
    {
        echo "<script>window.location.href = './mail/send.php?id=$id&name=$name&title=$title&status=$status&to=$to';</script>";
    }
}
?>



</html>