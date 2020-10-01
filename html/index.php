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
  <link rel="stylesheet" href="live2d/live2d/css/live2d.css" />

  <script>
  /*
    let startTime = (day) => {
        return new Date(day).getTime();
    }

    var sttime=startTime('2019-11-30 8:00:00');
    var edtime=startTime('2019-11-30 12:00:00');
    function uptime()
    {
        t0=new Date().getTime();
        document.getElementById("jdt").style="width:"+String((t0-sttime)*100/(edtime-sttime))+"%";
    }

    setInterval("uptime();",500);
    */
  </script>
</head>

<style>
    @font-face {
        font-family: 'fz';
        src: url('https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf');
    }
    .btn-success:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-warning:hover{
        background-color: #fd3;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-danger:hover{
        background-color: #f8b;
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

<?php require("./pack/head.php")?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">欢迎来到Ours~</h4>
            <p class="card-text">这是由云南师大附中校学生会网络部开发的网站，你可以点击下面可爱的按钮了解更多。</p>
            <div class="btn-group">
                <a href="./intro" class="btn btn-warning text-center">使用指南</a>
                <a href=<?php echo "http://".$_SERVER['HTTP_HOST']."/article/show.php?id=1"?> class="btn btn-primary text-center">关于我们</a>
				<a href="https://su-ours-public.oss-cn-hangzhou.aliyuncs.com/Ours.apk" class="btn btn-warning text-center">安卓APP</a>
            </div>
        </div>
	</div>
	
	<!--
	<br>
	<div class="card">
        <div class="card-body">
            <h1 style="text-align:center">逝者安息</h1>
        </div>
	</div>
	-->
	<br>
	<div class="card">
        <div class="card-body">
            <h2 style="text-align:center">欢迎23届小可爱们加入网络部(=・ω・=)</h2>
        </div>
	</div>
	
	<br>
    <div class="card">
        <div class="card-body">
            <a href="./timeletter" class="btn btn-primary btn-block">时光信笺</a>
            <a href="./MergeMusic" target="_blank" class="btn btn-success btn-block">聚合音乐</a>
            <a href="./sea" class="btn btn-danger btn-block">天气之子</a>
        </div>
    </div>

	<!--
    <br>
    <div class="card">
        <div class="card-body">
            <a href="./sea" class="btn btn-danger btn-block">学海水温侦测系统</a>
        </div>
    </div>

    <br>
    <div class="card">
    <div class="card-body">
        <h3 class="text-center">Day 3 早上好^_^</h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" id="jdt" style="width:0%"></div>
        </div>
    </div>
    </div>

    <br>
    <div class="card">
        <div class="card-body">
            <div>
            <h4 class="card-title" style="display:inline-block">成绩查询<h5 style="display:inline">(sport.suours.com)</h5></h4>
            </div>
            <div class="btn-group">
                <a href="https://sport.suours.com" class="btn btn-primary text-center">点击跳转</a>
                <a href="./follow" class="btn btn-warning text-center">订阅选手</a>
            </div>
        </div>
    </div>

    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">体育节摄影大赛</h4>
            <h6>&nbsp;&nbsp;&nbsp;&nbsp;也可点击右上角按钮选择'赛'进入</h6>
            <div class="btn-group">
                <a href="./game" class="btn btn-primary text-center">进入专区</a>
                <a href="./intro/game.html" class="btn btn-warning text-center">了解更多</a>
            </div>
        </div>
    </div>

    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">点歌</h4>
            <div class="btn-group">
                <a href="./music" class="btn btn-primary text-center">播放列表</a>
                <a href="./intro/music.html" class="btn btn-warning text-center">点歌指南</a>
            </div>
        </div>
	</div>
	-->

    <br>
    <script>
    $(document).ready(() => {
        $('#bt0').click();
    });

    setTimeout(() => {
        $("#bt0").click();
    },1500);
    </script>
</div>

<div id="landlord" style="opacity:1;">
    <div class="message" style="opacity:0.7"></div>
    <canvas id="live2d" width="250px" height="400px" style="width:125px;height:200px;"></canvas>
    <div class="hide-button">隐藏</div>
</div>

<script type="text/javascript">
    var message_Path = 'live2d/live2d/'
    var home_Path = 'http://suours.com/'
</script>
<script type="text/javascript" src="live2d/live2d/js/live2d.js"></script>
<script type="text/javascript" src="live2d/live2d/js/message.js"></script>
<script type="text/javascript">
    //a=document.getElementById("live2d").getContext("2d")
    loadlive2d("live2d", "./live2d/live2d/model/su/model.json");
</script>

</body>
</html>