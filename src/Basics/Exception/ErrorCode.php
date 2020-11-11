<?php
/**
 * @Created by PhpStorm
 * @author: injurys
 * @file: StatusCode.php
 */

namespace HugCode\WorkWeChat\Basics\Exception;


class ErrorCode
{

    const MISSING_CONFIG_CORPID = 10001;
    const MISSING_CONFIG_CORPSECRET = 10002;
    const MISSING_CONFIG_AGENT_ID = 10003;

    const REQUEST_ERROR_GET_TOKEN = 11001;
    const CACHE_DATA_FAIL = 11002;
    const CACHE_GET_DATA_FAIL = 11003;

    public static $message_list = [
        self::MISSING_CONFIG_CORPID     => '缺少配置参数 -- [corpid]',
        self::MISSING_CONFIG_CORPSECRET => '缺少配置参数 -- [corpsecret]',
        self::MISSING_CONFIG_AGENT_ID   => '缺少配置参数 -- [agentid]',
        self::REQUEST_ERROR_GET_TOKEN   => 'access_token获取失败',
        self::CACHE_DATA_FAIL           => '数据缓存失败',
        self::CACHE_GET_DATA_FAIL       => '获取缓存数据失败',
    ];

}
