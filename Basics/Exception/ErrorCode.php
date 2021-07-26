<?php
/**
 * @Created by PhpStorm
 * @author: hug-code
 * @file: StatusCode.php
 */

namespace HugCode\WorkWeChat\Basics\Exception;


class ErrorCode
{

    const MISSING_CONFIG_CORPID = 10001;
    const MISSING_CONFIG_CORPSECRET = 10002;
    const MISSING_CONFIG_AGENT_ID = 10003;
    const MISSING_CONFIG_ACCESS_TOKEN = 10004;

    const REQUEST_ERROR_GET_TOKEN = 11001;


    public static $message_list = [
        self::MISSING_CONFIG_CORPID       => '缺少配置参数 -- [corpid]',
        self::MISSING_CONFIG_CORPSECRET   => '缺少配置参数 -- [corpsecret]',
        self::MISSING_CONFIG_AGENT_ID     => '缺少配置参数 -- [agentid]',
        self::MISSING_CONFIG_ACCESS_TOKEN => '缺少配置参数 -- [access_token]',

        self::REQUEST_ERROR_GET_TOKEN => 'access_token获取失败',
    ];

}
