<?php
/**
 * @name: 发送应用消息
 * @Created by PhpStorm
 * @author: hug-code
 * @file: WxMessage.php
 */

namespace HugCode\WorkWeChat\Message;

use HugCode\WorkWeChat\Basics\HttpRequest;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

class WxMessage extends WxMessageBase
{

    const MESSAGE_SEND = '/cgi-bin/message/send';  // 应用消息
    const MESSAGE_UPDATE_TASKCARD = '/cgi-bin/message/update_taskcard'; // 更新任务卡片消息状态
    const MESSAGE_GET_STATISTICS = '/cgi-bin/message/get_statistics'; // 查询应用消息发送统计

    /**
     * @desc: 发送应用消息
     * @param array $params
     *        参数详见：https://work.weixin.qq.com/api/doc/90000/90135/90236
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/23 10:45
     */
    public function send(array $params = [])
    {
        $params['agentid'] = $this->getAgentId();
        $requestUrl        = self::BASE_URL . self::MESSAGE_SEND . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }


    /**
     * @desc: 更新任务卡片消息状态
     * https://work.weixin.qq.com/api/doc/90000/90135/91579
     * @param array $userids 企业的成员ID列表（消息接收者，最多支持1000个）。
     * @param array $taskId 发送任务卡片消息时指定的task_id
     * @param array $clickedKey 设置指定的按钮为选择状态，需要与发送消息时指定的btn:key一致
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/11/11 16:27
     */
    public function updateTaskcard($userids = [], $taskId = [], $clickedKey = [])
    {
        $params     = [
            'agentid'     => $this->getAgentId(),
            'userids'     => $userids,
            'task_id'     => $taskId,
            'clicked_key' => $clickedKey,
        ];
        $requestUrl = self::BASE_URL . self::MESSAGE_UPDATE_TASKCARD . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 查询应用消息发送统计
     * @param int $timeType 查询哪天的数据，0：当天；1：昨天。默认为0。
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/11/11 16:43
     */
    public function getStatistics($timeType = 0)
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::MESSAGE_GET_STATISTICS, [
            'access_token' => $this->access_token,
            'time_type'    => $timeType,
        ])->toArray();
    }


}
