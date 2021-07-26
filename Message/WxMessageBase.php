<?php
/**
 * @name: 群聊
 * @Created by PhpStorm
 * @author: hug-code
 * @file: WxAppChat.php
 */

namespace HugCode\WorkWeChat\Message;

use HugCode\WorkWeChat\Basics\BasicWeChat;
use HugCode\WorkWeChat\Basics\Exception\ErrorCode;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

class WxMessageBase extends BasicWeChat
{

    /**
     * @desc: 获取 agentid
     * @return array|string
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/23 10:55
     */
    protected function getAgentId()
    {
        $agentId = $this->config->get('agentid');
        if (empty($agentId)) {
            throw new MessageException(ErrorCode::MISSING_CONFIG_AGENT_ID);
        }
        return $agentId;
    }

}
