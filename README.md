# WorkWeChat
> 企业微信对接接口
>
> 官方文档：https://work.weixin.qq.com/api/doc/90000/90135/90664

#### 配置与方法调用
```php
$config = [
    'corpid'     => '**',  // 企业ID
    'corpsecret' => '**',
    'agentid'    => '**',  // 应用ID
];
$data = [];

$message = new HugCode\WorkWeChat\Message\WxMessage($config);
$result = $message->send($data);
```

因时间等原因，目前只开发了`通讯录管理`与`消息发送`两个模块

后续有时间会补充完整