<!DOCTYPE html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

$to="";
$name="";
$id="";
$status="";
$title="";

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    if(!empty($_GET['to']))$to=$_GET['to'];
    if(!empty($_GET['name']))$name=$_GET['name'];
    if(!empty($_GET['msg']))$msg=$_GET['msg'];
    if(!empty($_GET['title']))$title=$_GET['title'];
    
    // echo var_dump($_GET);

    //服务器配置
    $mail->CharSet ="UTF-8";                     //设定邮件编码
    $mail->SMTPDebug = 0;                        // 调试模式输出
    $mail->isSMTP();                             // 使用SMTP
    //$mail->Host = 'smtp.aliyun.com';                // SMTP服务器
	$mail->Host = 'smtp.qq.com';
    $mail->SMTPAuth = true;                      // 允许 SMTP 认证
    //$mail->Username = 'suours@aliyun.com';                // SMTP 用户名  即邮箱的用户名
	$mail->Username = '3253541727@qq.com';
    //$mail->Password = 'suours0075';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
	$mail->Password = '';
    $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
    $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

    //$mail->setFrom('suours@aliyun.com', 'SU-Ours');  //发件人
	$mail->setFrom('3253541727@qq.com', 'SU-Ours');
    $mail->addAddress($to, $name);  // 收件人
    //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
    //$mail->addReplyTo('suours@aliyun.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
	$mail->addReplyTo('3253541727@qq.com', $name);
    //$mail->addCC('cc@example.com');                    //抄送
    //$mail->addBCC('bcc@example.com');                    //密送

    //发送附件
    // $mail->addAttachment('../xy.zip');         // 添加附件
    // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

    //Content
    $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
    $mail->Subject = $title;

    $mail->Body    = $msg;

    $mail->send();
    //echo '邮件发送成功';
    //echo '<script>window.close()</script>';
	//echo "<script>window.location.href = '../';</script>";
	echo 1;
} catch (Exception $e) {
    //echo '邮件发送失败: ', $mail->ErrorInfo;
	echo 0;
}
?>

