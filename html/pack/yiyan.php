<?php
header('Content-type: text/html; charset=utf-8');
$file=file_get_contents("./yiyan.txt");
$data=explode(PHP_EOL,$file);
$yiyan='';
while($yiyan=='')$yiyan=$data[array_rand($data)];
echo $yiyan;
?>