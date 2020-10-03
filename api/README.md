# Ours API

这里是`Ours`提供的API（Application Programming Interface，应用程序接口）文档。

## 概述

主要使用基于`Python`的`Flask`作为后端，运行在`2333`端口上。

尽量统一使用`GET`和`POST`接口，返回`json`。（由于`GET`有长度限制和安全问题，非调试环境应尽量使用`POST`）

## API List

### send_mail

发送邮件，后端使用`Python`实现`SMTP`发送`QQ`邮件。

**请求格式 GET | POST**
| 参数 | 是否必须 | 示例 | 说明 |
| :-: | :-: | :-: | :-: |
| to | 是 | 3253541727@qq.com | 接收邮箱 |
| sub | 是 | 我是标题 | 邮件标题 |
| msg | 是 | 网络部~ | 邮件正文 |
| type | 否 | base64 | 正文编码 |
| to_name | 否 | SUND | 接收名字 |
| from_name | 否 | SUND | 发送名字 |

**返回格式 JSON**
| 参数 | 是否必须 | 示例 | 说明 |
| :-: | :-: | :-: | :-: |
| status | 是 | ok | 成功ok 失败error |

**Tips：**
* 如果`type`值为`base64`，那么`msg`的编码流程为 `origin -> base64 -> URLEncode`。这样做的原因是回车等特殊符号无法传输，而转为`base64`后还是会有`+`等特殊字符，于是再转为`URL`编码。例如`网络部~`编码后为`572R57uc6YOofg%3d%3d`。

* 字符量很可能超过`GET`限制，调试完成后尽可能使用`POST`。

* 一个完整的栗子：`/send_mail/?to=3253541727@qq.com&msg=572R57uc6YOofg%3d%3d&type=base64&sub=test&to_name=你的名字。&from_name=我的名字。`