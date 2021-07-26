<?php
/**
 * @name: 群聊
 * @Created by PhpStorm
 * @author: hug-code
 * @file: WxAppChat.php
 */

namespace HugCode\WorkWeChat\Message;

use HugCode\WorkWeChat\Basics\HttpRequest;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

class WxAppChat extends WxMessageBase
{

    const APP_CHAT_CREATE = '/cgi-bin/appchat/create';  // 创建群聊会话
    const APP_CHAT_UPDATE = '/cgi-bin/appchat/update';  // 修改群聊会话
    const APP_CHAT_GET = '/cgi-bin/appchat/get';  // 获取群聊会话
    const APP_CHAT_SEND = '/cgi-bin/appchat/send';  // 应用推送消息

    /**
     * @desc: 创建群聊会话
     * https://work.weixin.qq.com/api/doc/90000/90135/90245
     * @param string $name 群聊名，最多50个utf8字符，超过将截断
     * @param string $owner 指定群主的id。如果不指定，系统会随机从userlist中选一人作为群主
     * @param array $userList 群成员id列表。至少2人，至多2000人
     * @param string $chatid 群聊的唯一标志，不能与已有的群重复；字符串类型，最长32个字符。只允许字符0-9及字母a-zA-Z。如果不填，系统会随机生成群id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/11/11 16:30
     */
    public function create($name = '', $owner = '', $userList = [], $chatid = '')
    {
        $params     = [
            'name'     => $name,
            'owner'    => $owner,
            'userlist' => $userList,
            'chatid'   => $chatid,
        ];
        $requestUrl = self::BASE_URL . self::APP_CHAT_CREATE . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 修改群聊会话
     * https://work.weixin.qq.com/api/doc/90000/90135/90246
     * @param string $chatid 群聊id
     * @param string $name 新的群聊名。若不需更新，请忽略此参数。最多50个utf8字符，超过将截断
     * @param string $owner 新群主的id。若不需更新，请忽略此参数
     * @param array $addUserList 添加成员的id列表
     * @param array $delUserList 踢出成员的id列表
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/11/11 16:34
     */
    public function update($chatid = '', $name = '', $owner = '', $addUserList = [], $delUserList = [])
    {
        $params     = [
            'name'          => $name,
            'owner'         => $owner,
            'add_user_list' => $addUserList,
            'del_user_list' => $delUserList,
            'chatid'        => $chatid,
        ];
        $requestUrl = self::BASE_URL . self::APP_CHAT_UPDATE . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 获取群聊会话
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/11/11 16:39
     */
    public function get()
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::APP_CHAT_GET, [
            'access_token' => $this->access_token,
            'chatid'       => $this->getAgentId(),
        ])->toArray();
    }

    /**
     * @desc: 应用推送消息
     * @param array $params
     *              参数详情：https://work.weixin.qq.com/api/doc/90000/90135/90248
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/11/11 16:41
     */
    public function send($params = [])
    {
        $requestUrl = self::BASE_URL . self::APP_CHAT_SEND . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

}
