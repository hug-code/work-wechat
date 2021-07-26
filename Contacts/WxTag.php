<?php
/**
 * @name: 标签管理
 * @Created by PhpStorm
 * @author: hug-code
 * @Date: 2020/10/19 16:03
 */

namespace HugCode\WorkWeChat\Contacts;

use HugCode\WorkWeChat\Basics\BasicWeChat;
use HugCode\WorkWeChat\Basics\HttpRequest;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

class WxTag extends BasicWeChat
{

    const TAG_CREATE = '/cgi-bin/tag/create'; // 创建标签
    const TAG_UPDATE = '/cgi-bin/tag/update'; // 编辑标签
    const TAG_DELETE = '/cgi-bin/tag/delete'; // 删除标签
    const TAG_GET = '/cgi-bin/tag/get'; // 获取标签成员
    const TAG_ADD_TAG_USERS = '/cgi-bin/tag/addtagusers'; // 增加标签成员
    const TAG_DEL_TAG_USERS = '/cgi-bin/tag/deltagusers'; // 删除标签成员
    const TAG_LIST = '/cgi-bin/tag/list'; // 获取标签列表

    /**
     * @desc: 创建标签
     * @param string $tag_name 必填 标签名称，长度限制为32个字以内（汉字或英文字母），标签名不可与其他标签重名。
     * @param integer $tag_id 非必填 标签id，非负整型，指定此参数时新增的标签会生成对应的标签id，不指定时则以目前最大的id自增。
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 13:15
     */
    public function createTag($tag_name = '', $tag_id = 0)
    {
        $requestUrl = self::BASE_URL . self::TAG_CREATE . '?access_token=' . $this->access_token;
        $params     = [
            'tagname' => $tag_name,
            'tagid'   => $tag_id,
        ];
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 创建标签
     * @param string $tag_name 必填 标签名称，长度限制为32个字以内（汉字或英文字母），标签名不可与其他标签重名。
     * @param integer $tag_id 必填 标签id，非负整型，指定此参数时新增的标签会生成对应的标签id，不指定时则以目前最大的id自增。
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 13:15
     */
    public function updateTag($tag_name = '', $tag_id = 0)
    {
        $requestUrl = self::BASE_URL . self::TAG_UPDATE . '?access_token=' . $this->access_token;
        $params     = [
            'tagname' => $tag_name,
            'tagid'   => $tag_id,
        ];
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }


    /**
     * @desc: 读取成员
     * @param integer $tag_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:25
     */
    public function deleteTag($tag_id = 0)
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::TAG_DELETE, [
            'access_token' => $this->access_token,
            'tagid'        => $tag_id,
        ])->toArray();
    }

    /**
     * @desc: 获取标签成员
     * @param integer $tag_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:25
     */
    public function getTagUserList($tag_id = 0)
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::TAG_GET, [
            'access_token' => $this->access_token,
            'tagid'        => $tag_id,
        ])->toArray();
    }


    /**
     * @desc: 增加标签成员
     * @param integer $tag_id 必填  标签ID
     * @param array $user_list 非必填  企业成员ID列表，注意：userlist、partylist不能同时为空，单次请求个数不超过1000
     * @param array $party_list 非必填  企业部门ID列表，注意：userlist、partylist不能同时为空，单次请求个数不超过100
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 13:21
     */
    public function tagCreateUser($tag_id, $user_list = [], $party_list = [])
    {
        $requestUrl = self::BASE_URL . self::TAG_ADD_TAG_USERS . '?access_token=' . $this->access_token;
        $params     = [
            'tagid'     => $tag_id,
            'userlist'  => $user_list,
            'partylist' => $party_list,
        ];
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 删除标签成员
     * @param integer $tag_id 必填  标签ID
     * @param array $user_list 非必填  企业成员ID列表，注意：userlist、partylist不能同时为空，单次请求个数不超过1000
     * @param array $party_list 非必填  企业部门ID列表，注意：userlist、partylist不能同时为空，单次请求个数不超过100
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 13:21
     */
    public function tagDeleteUser($tag_id, $user_list = [], $party_list = [])
    {
        $requestUrl = self::BASE_URL . self::TAG_DEL_TAG_USERS . '?access_token=' . $this->access_token;
        $params     = [
            'tagid'     => $tag_id,
            'userlist'  => $user_list,
            'partylist' => $party_list,
        ];
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 获取标签列表
     * @param integer $tag_id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/20 9:25
     */
    public function getTagList($tag_id = 0)
    {
        $result = HttpRequest::instance()->get(self::BASE_URL . self::TAG_LIST, [
            'access_token' => $this->access_token,
        ])->toArray();
        return $result['taglist'];
    }


}
