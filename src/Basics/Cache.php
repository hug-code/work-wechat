<?php
/**
 * @Created by PhpStorm
 * @author: yashuai
 * @file: Cache.php
 */

namespace HugCode\WorkWeChat\Basics;

use HugCode\WorkWeChat\Basics\Exception\ErrorCode;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

trait Cache
{

    protected $frame_type = 'yii';  // 框架类型
    protected $prefix = 'WordWeChat:';


    /**
     * @desc: 缓存数据
     * @param string $key
     * @param string $value
     * @param int $expires_in
     * @throws MessageException
     * @author: yashuai
     * @Date: 2020/10/19 17:37
     */
    protected function setCache($key = '', $value = '', $expires_in = 7200)
    {
        try {
            switch (strtolower($this->frame_type)) {
                case 'yii':
                    \Yii::$app->redis->setex($key, $expires_in, $value);  // 缓存token信息
                    break;
                default:
                    throw new MessageException(ErrorCode::CACHE_DATA_FAIL);
                    break;
            }
        } catch (\Exception $e) {
            throw new MessageException(ErrorCode::CACHE_DATA_FAIL);
        }
    }


    /**
     * @desc: 读取缓存数据
     * @param string $key
     * @return string
     * @throws MessageException
     * @author: yashuai
     * @Date: 2020/10/20 14:13
     */
    protected function getCache($key = '')
    {
        try {
            switch (strtolower($this->frame_type)) {
                case 'yii':
                    return \Yii::$app->redis->get($key);  // 缓存token信息
                    break;
                default:
                    return '';
                    break;
            }
        } catch (\Exception $e) {
            throw new MessageException(ErrorCode::CACHE_GET_DATA_FAIL);
        }
    }

    /**
     * @desc: 获取redis键名
     * @param string $value1
     * @param string $value2
     * @return string
     * @author: yashuai
     * @Date: 2020/10/19 17:41
     */
    protected function getCacheKey($value1 = '', $value2 = '')
    {
        return $this->prefix . md5($value1 . $value2);
    }

}