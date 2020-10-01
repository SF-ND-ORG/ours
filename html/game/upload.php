<!DOCTYPE html>
<html>
<head>
  <title>SU-Ours</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<style>
  @font-face {
        font-family: fz;
        src: url(https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf)
    }
    .btn:hover{
        background-color: #39e !important;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    #submit{
        background-color:#eee;
    }

    #upload{
        background-color:#eee;
    }

    .navbar-brand:hover{
      transition:all 0.5s ease-in-out;
      text-shadow: 0px 0px 5px  #fee;
    }

    [aria-expanded=true]{
      border-color: #f99 !important;
    }

    .card{
      transition:all 0.3s ease-in-out;
    }
    .card:hover{
      box-shadow: 0 0 5px 3px #ddd;
    }
    
    body{
        font-family: fz;
    }

    img:hover{
        box-shadow: 0 0 5px 3px #bbb;
    }
    img{
        transition:all 0.3s ease-in-out
    }
</style>

<body>


<?php
$name=$name_wa=$grade=$class_type=$class=$class_wa=$qq=$qq_wa=$tel=$tel_wa=$file_wa='';
$title=$title_wa=$tag=$file_num=$mail=$mail_wa='';
$noshow='0';
$ct=$size=$width=$height=0;
?>



<?php
$gametag="体育节2019";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(empty($_POST["name"])) $name_wa="某鱼塘都有名字呢！";
    else
    {
        $name=$_POST["name"];
        if(strlen($name)>12 || !preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$name))$name_wa="何方神圣！";
        else
        {
            $ct++;
            $name=addslashes($name);
        }
    }

    if(empty($_POST["grade"])||empty($_POST["class_type"])||empty($_POST["class"])) $class_wa="emmm你哪个班的呀";
    else
    {
        $grade=$_POST["grade"];
        $class_type=$_POST["class_type"];
        $class=$_POST["class"];

        if(preg_match("/[^0-9]/",$grade) || preg_match("/[^0-9]/",$class) || strlen($grade)!=4 || (int)$class>18)$class_wa="不存在的吧";
        elseif($class_type=="W" && (int)$class>6)$class_wa="不存在的吧";
        elseif($class_type=="L" && (int)$class>12)$class_wa="不存在的吧";
        else $ct++;
    }

    if(empty($_POST["qq"]))$qq_wa="告诉我嘛~";
    else
    {
        $qq=$_POST["qq"];
        if(preg_match("/[^0-9]/",$qq))$qq_wa="马化腾说没这个号码";
        else $ct++;
    }

    if(empty($_POST["tel"]))$tel_wa="告诉我嘛~";
    else
    {
        $tel=$_POST["tel"];
        if(preg_match("/[^0-9]/",$tel) || strlen($tel)!=11)$tel_wa="不是这个亚子的！";
        else $ct++;
    }

    if(!empty($_POST["mail"]))
    {
        $mail=$_POST["mail"];
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$mail))
        {
            $mail_wa="不是这个亚子的！";
            $ct--;
        }
    }

    if(empty($_POST["title"])) $title_wa="某石头堆都有名字呢！";
    else
    {
        $title=$_POST["title"];
        if(mb_strlen($title)>23)$title_wa="说了不能超23个字来着";
        else $ct++;
        $title=addslashes($title);
    }

    if(!empty($_POST["tag"]))$tag=addslashes("\r\n".$_POST["tag"]."\r\n");

    if(!empty($_POST["noshow"]))$noshow=$_POST["noshow"];

    
    if($_FILES["file"]["name"]=="")$file_wa="木有啊";
    else
    {
        $allowedExts = array("gif", "jpeg", "jpg", "png","JPG","JPEG","PNG");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);        // 获取文件后缀名
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && in_array($extension, $allowedExts))
        {
            if ($_FILES["file"]["error"] > 0)
            {
                $file_wa="出错啦：" . $_FILES["file"]["error"];
            }
            elseif($_FILES["file"]["size"]>=20971520)
            {
                $file_wa="超过20M受不起orz";
            }
            else
            {
                $gis=getimagesize($_FILES['file']['tmp_name']);
                $width=$gis[0];
                $height=$gis[1];
                $size=$_FILES['file']['size'];
                $ct++;
            }
        }
        else
        {
            $file_wa="这都什么玩意儿";
        }
    }

    if($ct==6)//可以写入了
    {
        $dbhost="localhost:3306";
        $dbuser="root";
        $dbpass="PASSWORD";
        $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
        mysqli_query($conn,"set names utf8");

        $mtag=$tag."\r\n".$gametag."\r\n";

        $sql="insert into img_tmp".
            "(name,grade,class_type,class,qq,tel,title,noshow,tag,date,file_type,".
            "height,width,size,mail)".
            "VALUES".
            "('$name','$grade','$class_type',$class,'$qq','$tel','$title',$noshow,".
            "'$mtag',NOW(),'$extension',$height,$width,$size,'$mail')";
        
        mysqli_select_db($conn,'ours');
        mysqli_query($conn,$sql);

        $sql="select last_insert_id()";
        $retval=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($retval);
        $file_num=$row['last_insert_id()'].'.';

        move_uploaded_file($_FILES["file"]["tmp_name"], "../tmp/image/".$file_num.$extension);

        //copy($_FILES["file"]["tmp_name"],"../tmp/image/".$file_num.$extension);
        /*
        $file=fopen("../tmp/image/".$file_num."txt","w");
        fwrite($file,$name."\r\n");
        fwrite($file,$grade."\r\n");
        fwrite($file,$class_type."\r\n");
        fwrite($file,$class."\r\n");
        fwrite($file,$qq."\r\n");
        fwrite($file,$tel."\r\n");
        fwrite($file,$title."\r\n");
        fwrite($file,$noshow."\r\n");
        fwrite($file,$file_num.$extension."\r\n");
        fwrite($file,$tag);
        fclose($file);*/
    }

    if($title!="")$title=stripslashes($title);
    if($tag!="")$tag=stripslashes(substr($tag,2,-2));
}
?>

<!-- 模态框 -->
<div class="modal fade" id="myModal">
<div class="modal-dialog">
    <div class="modal-content">

    <!-- 模态框主体 -->
    <div class="modal-body">
        <div class="alert alert-success">
            <?php echo $ct==6?'上传成功咯^_^  '.'@'.$file_num.$extension:'';?>
        </div>
    </div>

    <!-- 模态框底部 -->
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
    </div>

    </div>
</div>
</div>

<!-- 模态框 -->
<div class="modal fade" id="myModal2">
<div class="modal-dialog">
    <div class="modal-content">
    <!-- 模态框主体 -->
    <div class="modal-body">
        <div class="alert alert-success text-center">
            <h5>正在上传，请稍后qwq</h5>
            <div class='progress'><div class='progress-bar bg progress-bar-striped progress-bar-animated' style='width:100%'></div></div>
        </div>
    </div>
    </div>
</div>
</div>

<?php
if($ct==6)echo '<script>$("#myModal").modal("show");</script>';
?>

<?php require("../pack/head.php")?>

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">图片上传<h5>——体育节摄影大赛专区</h5></h4>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">姓名</span>
                </div>
                <input type="text" class="form-control" placeholder="如:李华" name="name" value="<?php echo $name;?>">
                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $name_wa;?></span>
                </div>
            </div>

            <div class="input-group">
                <input type="text" class="form-control" placeholder="如:2021" name="grade" value="<?php echo $grade;?>">
                <div class="input-group-append">
                    <span class="input-group-text">届</span>
                </div>
            </div>

            <div class="input-group">
                <select class="form-control" name="class_type">
                    <option value="N" <?php echo $class_type=="N"?"selected":"";?>>高一</option>
                    <option value="W" <?php echo $class_type=="W"?"selected":"";?>>文</option>
                    <option value="L" <?php echo $class_type=="L"?"selected":"";?>>理</option>
                </select>

                <input type="text" class="form-control" placeholder="如:1" name="class" value="<?php echo $class;?>">
                <div class="input-group-append">
                    <span class="input-group-text">班</span>
                </div>

                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $class_wa;?></span>
                </div>

            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">&nbspQ&nbspQ&nbsp</span>
                </div>
                <input type="text" class="form-control" placeholder="如:1525876733" name="qq" value="<?php echo $qq;?>">
                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $qq_wa;?></span>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">电话</span>
                </div>
                <input type="text" class="form-control" placeholder="如:13388718156" name="tel" value="<?php echo $tel;?>">
                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $tel_wa;?></span>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">邮箱</span>
                </div>
                <input type="mail" class="form-control" placeholder="如:1525876733@qq.com" name="mail" value="<?php echo $mail;?>">
                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $mail_wa;?></span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-text form-control" style="color:#888">邮箱为选填项，仅用于接收审核状态</span>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">标题</span>
                </div>
                <input type="text" class="form-control" placeholder="不能超过23个字哦" name="title" value="<?php echo $title;?>">
                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $title_wa;?></span>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">标签</span>
                </div>
                <textarea class="form-control" rows="5" name="tag" placeholder="一行一个，如：&#10书山&#10学海"><?php echo $tag;?></textarea>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">隐藏联系方式</span>
                </div>
                <div class="input-group-text form-control">
                    <input type="checkbox" name="noshow" value=1>
                </div>
            </div>

            <div class="input-group">
                <input type="file" class="form-control" name="file" id="upload">
                <div class="input-group-append">
                    <span class="input-group-text" style="color:#e66"><?php echo $file_wa;?></span>
                </div>
            </div>

            <div class="input-group">
                <input type="submit" class="btn btn-block" value="提交" name="submit" id="submit" onclick="clk()">
            </div>
        </form>

      </div>
   
</div>

<script>
function clk()
{
    <?php $ifup=1?>
    $("#myModal2").modal("show");
}
</script>

<?php
/*
echo $ct;
echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"]."</br>";
echo var_dump($_FILES["file"]["type"]);
echo "</br></br>";
echo var_dump(preg_match("/\n/",$tag));
*/
?>

</body>
</html>