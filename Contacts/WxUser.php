<?php
/**
 * @name: 成员管理
 * @Created by PhpStorm
 * @author: hug-code
 * @file: WxUser.php
 */

namespace HugCode\WorkWeChat\Contacts;

use HugCode\WorkWeChat\Basics\BasicWeChat;
use HugCode\WorkWeChat\Basics\HttpRequest;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

class WxUser extends BasicWeChat
{

    const USER_CREATE = '/cgi-bin/user/create';  // 创建成员
    const USER_GET = '/cgi-bin/user/get';  // 读取成员
    const USER_UPDATE = '/cgi-bin/user/update'; // 更新成员
    const USER_DELETE = '/cgi-bin/user/delete'; // 删除成员
    const USER_BATCH_DELETE = '/cgi-bin/user/batchdelete';  // 批量删除成员
    const USER_SIMPLE_LIST = '/cgi-bin/user/simplelist'; // 获取部门成员
    const USER_LIST = '/cgi-bin/user/list';  // 获取部门成员详情
    const CONVERT_TO_OPENID = '/cgi-bin/user/convert_to_openid'; // userid转openid
    const CONVERT_TO_USERID = '/cgi-bin/user/convert_to_userid'; // openid转userid

    /**
     * @desc: 添加成员
     * @param array $params
     *              参数详情：https://work.weixin.qq.com/api/doc/90000/90135/90195
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:17
     */
    public function createUser(array $params = [])
    {
        $requestUrl = self::BASE_URL . self::USER_CREATE . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 读取成员
     * @param string $user_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:25
     */
    public function getUserInfo($user_id = '')
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::USER_GET, [
            'access_token' => $this->access_token,
            'userid'       => $user_id,
        ])->toArray();
    }

    /**
     * @desc: 更新成员
     * @param array $params
     *              参数详情：https://work.weixin.qq.com/api/doc/90000/90135/90195
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:17
     */
    public function updateUser(array $params = [])
    {
        $requestUrl = self::BASE_URL . self::USER_UPDATE . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }


    /**
     * @desc: 删除成员
     * @param string $user_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/19 17:54
     */
    public function deleteUser($user_id = null)
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::USER_DELETE, [
            'access_token' => $this->access_token,
            'userid'       => $user_id,
        ])->toArray();
    }


    /**
     * @desc: 批量删除成员
     * @param array $user_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/19 17:54
     */
    public function batchDeleteUser($user_id = [])
    {
        $requestUrl = self::BASE_URL . self::USER_BATCH_DELETE . '?access_token=' . $this->access_token;
        $data       = [
            'useridlist' => $user_id,
        ];
        return HttpRequest::instance()->post($requestUrl, json_encode($data))->toArray();
    }

    /**
     * @desc: 读取部门成员
     * @param string $department_id 部门ID
     * @param integer $fetch_child 是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:25
     */
    public function getSimpleList($department_id = '', $fetch_child = 0)
    {
        $result = HttpRequest::instance()->get(self::BASE_URL . self::USER_SIMPLE_LIST, [
            'access_token'  => $this->access_token,
            'department_id' => $department_id,
            'fetch_child'   => $fetch_child,
        ])->toArray();
        return $result['userlist'];
    }

    /**
     * @desc: 读取部门成员详情
     * @param string $department_id 部门ID
     * @param integer $fetch_child 是否递归获取子部门下面的成员：1-递归获取，0-只获取本部门
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:25
     */
    public function getList($department_id = '', $fetch_child = 0)
    {
        $result = HttpRequest::instance()->get(self::BASE_URL . self::USER_LIST, [
            'access_token'  => $this->access_token,
            'department_id' => $department_id,
            'fetch_child'   => $fetch_child,
        ])->toArray();
        return $result['userlist'];
    }

    /**
     * @desc: userId 转 openID
     * @param string $user_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 13:05
     */
    public function convertToOpenId($user_id = '')
    {
        $requestUrl = self::BASE_URL . self::CONVERT_TO_OPENID . '?access_token=' . $this->access_token;
        $result     = HttpRequest::instance()->post($requestUrl, json_encode([
            'userid' => $user_id,
        ]))->toArray();
        return $result['openid'];
    }

    /**
     * @desc: openid转userid
     * @param string $open_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 13:05
     */
    public function convertToUserId($open_id = '')
    {
        $requestUrl = self::BASE_URL . self::CONVERT_TO_USERID . '?access_token=' . $this->access_token;
        $result     = HttpRequest::instance()->post($requestUrl, json_encode([
            'openid' => $open_id,
        ]))->toArray();
        return $result['userid'];
    }

}
