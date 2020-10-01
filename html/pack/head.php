<nav class="navbar bg-danger navbar-dark">
  <a class="navbar-brand" href=<?php echo "http://".$_SERVER['HTTP_HOST']?>>
      <h3 style="display: inline;">Ours</h3>
      <h6 style="display: inline">&nbsp&nbsp&nbsp&nbsp——<?php echo file_get_contents('http://localhost/pack/yiyan.php');?></h6>
    </a>
  <button id="bt0" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="outline:none;">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "http://".$_SERVER['HTTP_HOST']."/image"?>>景</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "http://".$_SERVER['HTTP_HOST']."/article"?>>文</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "http://".$_SERVER['HTTP_HOST']."/timeletter"?>>信</a>
      </li>   
    </ul>
  </div>  
</nav>
<br>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a6bc92b553163ae26fadce961a0713cf";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
