<?php
/**
 * @Created by PhpStorm
 * @author: hug-code
 * @file: DingTalkCloudException.php
 */

namespace HugCode\WorkWeChat\Basics\Exception;

use Exception;

abstract class WorkWeChatException extends Exception
{

    /**
     * @var string
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @desc:
     * @param int $code
     * @return string
     */
    public function codeGetMessage($code = 0)
    {
        return isset(ErrorCode::$message_list[$code]) ? ErrorCode::$message_list[$code] : 'unknown error';
    }

}
