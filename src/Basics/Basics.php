<?php
/**
 * @Created by PhpStorm
 * @author: yashuai
 * @file: BaseFunction.php
 * @Date: 2020/10/19 16:08
 */

namespace HugCode\WorkWeChat\Basics;

class Basics
{

    use Cache;

    const BASE_URL = 'https://qyapi.weixin.qq.com/';  // 请求地址
    const ACCESS_TOKEN = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken'; // 获取token

    /**
     * access_toke
     * @var string
     */
    protected $access_token;

}