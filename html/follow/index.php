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
<script>
</script>

<script>
function upload()
{
    var xmlhttp; xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        if(xmlhttp.responseText=="1")
        {
          $("#H").html("成功");
        }
        else
        {
          $("#H").html("好像哪里不大对Orz");
        }
      }
    }
    xmlhttp.open("GET","./upload.php?"+$("form").serialize(),true);
    xmlhttp.send();
}


function download()
{
    var xmlhttp; xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        $("#H").html("");
        list=JSON.parse(xmlhttp.responseText);
        for(var i=0;i<list.length;i++)
        {
          $("#H").append(list[i]+"<br>");
        }
      }
    }
    xmlhttp.open("GET","./search.php?"+$("form").serialize(),true);
    xmlhttp.send();
}
</script>

</head>

<style>
    @font-face {
        font-family: 'fz';
        src: url('https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf');
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

    img:hover{
        box-shadow: 0 0 5px 3px #bbb;
    }
    img{
        transition:all 0.3s ease-in-out
    }

    .navbar-brand:hover{
      transition:all 0.5s ease-in-out;
      text-shadow: 0px 0px 5px  #fee;
    }

    [aria-expanded=true]{
      border-color: #f99 !important;
    }

    body{
        font-family: 'fz';
    }
    
    .card{
      transition:all 0.3s ease-in-out;
    }
    .card:hover{
      box-shadow: 0 0 5px 3px #ddd;
    }
</style>

<body>

<?php require("../pack/head.php")?>


<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">订阅选手</h4>
        <hr>
        <p>
        订阅的选手信息更新后将通过QQ提醒,
        因此请确保已经关注校学生会官方QQ(3253541727)。
        订阅班级会接收班级所有选手的信息，
        注意22届小于10的班级需要添加前缀0。
        <br>姓名示例:蔡徐坤
        <br>班级示例:2209<br>
        请注意每行一个，否则可能会导致解析失败。
        建议订阅前后先查询。
        </p>
        <hr>
        
        <form method="get" enctype="multipart/form-data">

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">&nbspQ&nbspQ&nbsp</span>
                </div>
                <input type="text" id="qq" class="form-control" placeholder="如:1525876733" name="qq" value="<?php echo $qq;?>">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">列表</span>
                </div>
                <textarea class="form-control" rows="5" name="list" placeholder="一行一个，如：&#10;蔡徐坤&#10;21L9&#10;2202"><?php echo $list;?></textarea>
            </div>

               </form>
            <button class="btn btn-block" onclick="upload();">提交</button>
            <button class="btn btn-block" onclick="download();">查询我的订阅</button>
        
      </div>
      </div>


      <div class="card">
      <div class="card-body">
        <h4 class="card-title" id="H"></h4>
      </div>
      </div>


</body>
</html>