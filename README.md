# WorkWeChat
> 企业微信对接接口
>
> 官方文档：https://work.weixin.qq.com/api/doc/90000/90135/90664

#### 配置与方法调用 (参考)
```php
$config = [
    'corpid'     => '**',  // 企业ID
    'corpsecret' => '**',
    'agentid'    => '**',  // 应用ID
];

try{
    $message = new HugCode\WorkWeChat\Message\WxMessage($config);
    $result = $message->send([]);
} catch (\HugCode\WorkWeChat\Basics\Exception\WorkWeChatException $e) {
    var_dump($e->getErrorMessage(), $e->getErrorCode());
}
```

> 因工作上需要，功能未全部对接，可根据需要自行补充
