<?php

namespace HugCode\WorkWeChat\Basics;

use HugCode\WorkWeChat\Basics\Exception\ErrorCode;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

/**
 * Class BasicWeChat
 * @package WeChat\Contracts
 */
class BasicWeChat extends Basics
{

    use Cache;


    /**
     * 当前微信配置
     * @var DataArray
     */
    protected $config;


    /**
     * BasicWeChat constructor.
     * @param array $options
     * @throws MessageException
     */
    public function __construct(array $options)
    {
        if (empty($options['corpid'])) {
            throw new MessageException(ErrorCode::MISSING_CONFIG_CORPID);
        }
        if (empty($options['corpsecret'])) {
            throw new MessageException(ErrorCode::MISSING_CONFIG_CORPSECRET);
        }
        $this->frame_type = $options['frame_type'] ?? 'yii';
        $this->config     = new DataArray($options);
        $this->getAccessToken();
    }

    /**
     * 获取访问 AccessToken
     * @return mixed|string
     * @throws MessageException
     */
    protected function getAccessToken()
    {
        $cacheKey           = $this->getCacheKey($this->config->get('corpid'), $this->config->get('corpsecret'));
        $this->access_token = $this->getCache($cacheKey);
        if (empty($this->access_token)) {
            $result             = HttpRequest::instance()->get(self::ACCESS_TOKEN, [
                'corpid'     => $this->config->get('corpid'),
                'corpsecret' => $this->config->get('corpsecret'),
            ])->toArray();
            $this->access_token = $result['access_token'];
            $this->setCache($cacheKey, $result['access_token'], ($result['expires_in'] - 100));
        }
        return $this->access_token;
    }

}