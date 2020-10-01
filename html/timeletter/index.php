<!DOCTYPE html>

<html>
<head>
  <title>SU-Ours</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<style>
    @font-face {
        font-family: fz;
        src: url("https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf")
    }
    body {
        font-family: fz;
    }

    .bgimg{
    position:fixed;
    width:100%;
    height:100%;
    z-index:-10;
    zoom: 1;
    background-color: #fff;
    background: url(https://open.saintic.com/api/bingPic/) no-repeat;
    background-size: cover;
    -webkit-background-size: cover;
    -o-background-size: cover;
    background-position: center 0;
    }

    .card{
        background-color:rgba(255,255,255,0.3);
        transition:all 0.3s ease-in-out;
    }
    .card:hover{
        background-color:rgba(255,255,255,0.6);
        box-shadow: 0 0 5px 3px #ddd;
    }

    #mycard{
        background-color:rgba(255,255,255,0.5);
        transition:all 0.3s ease-in-out;
    }
    #mycard:hover{
        background-color:rgba(255,255,255,0.8);
        box-shadow: 0 0 5px 3px #ddd;
    }

    .input-group-text{
        background-color:rgba(255,255,255,0.3);
        transition:all 0.3s ease-in-out;
    }
    .input-group-text:hover{
        background-color:rgba(255,255,255,0.5);
        box-shadow: 0 0 5px 3px #ddd;
    }

    .form-control{
        background-color:rgba(255,255,255,0.3);
        transition:all 0.3s ease-in-out;
    }
    .form-control{
        background-color:rgba(255,255,255,0.5);
        box-shadow: 0 0 5px 3px #ddd;
    }

    .btn:hover{
        background-color: rgba(225,225,225,0.6);
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }
</style>

<script>
    window.onload = function () {
        test();
        window.setInterval(test, 10000); 

        document.getElementById("recvt").flatpickr();
    }

    function test(){
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', 'https://v1.hitokoto.cn/', true);
        httpRequest.send();

        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                var json =JSON.parse(httpRequest.responseText);
                document.getElementById("hitokoto").innerHTML=json['hitokoto'];
                document.getElementById("hitokoto_from").innerHTML="——"+json['from'];
            }
        };
    }

    function check(){
        revt=document.getElementById("recvt").value;
        if(revt=="" || new Date(revt) <= new Date()){
            document.getElementById("recvt_wa").innerHTML="时间设置错误";
        }
        else{
            document.getElementById("recvt_wa").innerHTML="";
            $("#myModal").modal("show");
        }
    }

    function submit(){
        data = $("#myform").serialize();
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', './upload.php', true);
        httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        httpRequest.send(data);

        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                if(httpRequest.responseText=="ok"){
                    $("#myModal2").modal("show");
                }
            }
        };
        
    }
</script>

<body>
    <div class="bgimg"></div>
    <?php require("../pack/head.php")?>
    <div class='container-fluid'>
        
        <div class="card"><div class="card-body">
            <h3 class="card-title">时光信笺-<i>Time Letter</i></h3>
                <span  style="color:#606975">均为选填，即使是漂泊的无名信</span>
				</br>
				<span>现仅QQ保证可用，需要接收方和SF网络部_Official(3253541727)为好友</span>
                <form id="myform">
                    <span class="input-group-text form-control">寄信人</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">名字</span>
                        </div>
                        <input type="text" class="form-control" name="from_name" id="from_name">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">&nbspQ&nbspQ&nbsp</span>
                        </div>
                        <input type="text" class="form-control" name="from_qq" id="from_qq">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">电话</span>
                        </div>
                        <input type="text" class="form-control" name="from_tel" id="from_tel">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">邮箱</span>
                        </div>
                        <input type="text" class="form-control" name="from_mail" id="from_mail">
                    </div>


                    <span class="input-group-text form-control">收信人</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">名字</span>
                        </div>
                        <input type="text" class="form-control" name="to_name" id="to_name">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">&nbspQ&nbspQ&nbsp</span>
                        </div>
                        <input type="text" class="form-control" name="to_qq" id="to_qq">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">电话</span>
                        </div>
                        <input type="text" class="form-control" name="to_tel" id="to_tel">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">邮箱</span>
                        </div>
                        <input type="text" class="form-control" name="to_mail" id="to_mail">
                    </div>


                    <span class="input-group-text form-control">派送时间</span>
                    <div class="input-group">
                        <input type="text" id="recvt" name="recvt" class="flatpickr form-control" data-enable-time=true data-enable-seconds=true >
                        <div class="input-group-append">
                            <span class="input-group-text" style="color:#e66" id="recvt_wa"></span>
                        </div>
                    </div>

                    <span class="input-group-text form-control">信的内容</span>
                    <div class="input-group">
                        <textarea class="form-control" rows="10" name="atc"></textarea>
                    </div>

                    <div class="input-group">
                    <btn class="btn btn-block form-control" name="submit" id="submit" onclick="check()">投递</btn>
                    </div>

                </form>
        </div></div>

        </br>
        <div class="card" id="mycard">
            <div class="card-body">
                <h3 id="hitokoto"></h3>
                <h4 id="hitokoto_from" align="right"></h4>
            </div>
        </div>
        </br>
    </div>
    
</body>

<!-- 模态框 -->
<div class="modal fade" id="myModal">
<div class="modal-dialog">
    <div class="modal-content">
    <!-- 模态框主体 -->
    <div class="modal-body">
            <h5 align=center>投递出的信笺就再也无法收回了，在那一刻到来之前，也都看不到了哦</h5>
            <btn class="btn btn-block btn-primary" data-dismiss="modal" onclick="submit()">确认</btn>
            <btn class="btn btn-block btn-danger" data-dismiss="modal">取消</btn>
        </div>
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
            <h5 align=center>投递成功</h5>
            <btn class="btn btn-block btn-primary" data-dismiss="modal">确认</btn>
        </div>
    </div>
    </div>
</div>
</div>

</html>