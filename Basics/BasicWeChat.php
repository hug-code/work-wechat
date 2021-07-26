<?php

namespace HugCode\WorkWeChat\Basics;

use HugCode\WorkWeChat\Basics\Exception\ErrorCode;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

/**
 * Class BasicWeChat
 * @package WeChat\Contracts
 */
class BasicWeChat
{

    const BASE_URL = 'https://qyapi.weixin.qq.com/';  // 请求地址
    const ACCESS_TOKEN = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken'; // 获取token

    /**
     * access_toke
     * @var string
     */
    protected $access_token;


    /**
     * 当前微信配置
     * @var DataArray
     */
    protected $config;


    /**
     * BasicWeChat constructor.
     * @param array $options
     * @param bool $v_token
     * @throws MessageException
     */
    public function __construct(array $options, $v_token = true)
    {
        if (empty($options['corpid'])) {
            throw new MessageException(ErrorCode::MISSING_CONFIG_CORPID);
        }
        if (empty($options['corpsecret'])) {
            throw new MessageException(ErrorCode::MISSING_CONFIG_CORPSECRET);
        }
        $this->config = new DataArray($options);
        if ($this->config->get('access_token')) {
            $this->access_token = $this->config->get('access_token');
        } else if ($v_token) {
            throw new MessageException(ErrorCode::GET_TOKEN_ERROR);
        }
    }

    /**
     * 获取访问 AccessToken
     * @return mixed|string
     * @throws MessageException
     */
    protected function getAccessToken()
    {
        return HttpRequest::instance()->get(self::ACCESS_TOKEN, [
            'corpid'     => $this->config->get('corpid'),
            'corpsecret' => $this->config->get('corpsecret'),
        ])->toArray();
    }

}
