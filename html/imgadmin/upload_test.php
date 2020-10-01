<?php
require_once './aliyun-oss-php-sdk-2.3.0.phar';

use OSS\OssClient;
use OSS\Core\OssException;


// 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
$accessKeyId = "";
$accessKeySecret = "";
// Endpoint以杭州为例，其它Region请按实际情况填写。
$endpoint = "oss-cn-hangzhou-internal.aliyuncs.com";
// 存储空间名称
$bucket= "su-ours";
// 文件名称
$object = "img/1.jpg";
// <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt
$filePath = getcwd()."/1.jpg";

try{
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

    $ossClient->uploadFile($bucket, $object, $filePath);
} catch(OssException $e) {
    printf(__FUNCTION__ . ": FAILED\n");
    printf($e->getMessage() . "\n");
    return;
}
print(__FUNCTION__ . ": OK" . "\n");
?>