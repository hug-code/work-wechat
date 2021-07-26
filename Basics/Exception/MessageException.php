<?php
/**
 * @Created by PhpStorm
 * @author: hug-code
 * @file: MessageException.php
 */

namespace HugCode\WorkWeChat\Basics\Exception;


class MessageException extends WorkWeChatException
{

    /**
     * MessageException constructor.
     * @param $errorCode
     * @param null $errorMessage
     * @param null $previous
     */
    public function __construct($errorCode, $errorMessage = null, $previous = null)
    {
        if (empty($errorMessage)) {
            $errorMessage = $this->codeGetMessage($errorCode);
        }
        parent::__construct($errorMessage, 0, $previous);
        $this->errorMessage = $errorMessage;
        $this->errorCode    = $errorCode;
    }


}
