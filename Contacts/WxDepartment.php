<?php
/**
 * @name: 部门管理
 * @Created by PhpStorm
 * @author: hug-code
 * @file: DepartmentBaseUrl.php
 */

namespace HugCode\WorkWeChat\Contacts;

use HugCode\WorkWeChat\Basics\BasicWeChat;
use HugCode\WorkWeChat\Basics\HttpRequest;
use HugCode\WorkWeChat\Basics\Exception\MessageException;

class WxDepartment extends BasicWeChat
{

    const DEPARTMENT_CREATE = '/cgi-bin/department/create';  // 创建部门
    const DEPARTMENT_UPDATE = '/cgi-bin/department/update'; // 更新部门
    const DEPARTMENT_DELETE = '/cgi-bin/department/delete'; // 删除部门
    const DEPARTMENT_LIST = '/cgi-bin/department/list'; // 获取部门列表

    /**
     * @desc: 获取部门列表
     * @param string $id 部门id。获取指定部门及其下的子部门（以及及子部门的子部门等等，递归）。 如果不填，默认获取全量组织架构
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/19 17:54
     */
    public function getDepartmentList($id = null)
    {
        $result = HttpRequest::instance()->get(self::BASE_URL . self::DEPARTMENT_LIST, [
            'access_token' => $this->access_token,
            'id'           => $id,
        ])->toArray();
        return $result['department'];
    }

    /**
     * @desc: 添加部门
     * @param array $params 参数：https://work.weixin.qq.com/api/doc/90000/90135/90205
     *               name        是    部门名称。同一个层级的部门名称不能重复。长度限制为1~32个字符，字符不能包括\:?”<>｜
     *               name_en        否    英文名称。同一个层级的部门名称不能重复。需要在管理后台开启多语言支持才能生效。长度限制为1~32个字符，字符不能包括\:?”<>｜
     *               parentid    是    父部门id，32位整型
     *               order        否    在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
     *               id            否    部门id，32位整型，指定时必须大于1。若不填该参数，将自动生成id
     * @return mixed
     * @throws MessageException
     * @Date: 2020/10/19 17:57
     * @author: hug-code
     */
    public function createDepartment(array $params = [])
    {
        $requestUrl = self::BASE_URL . self::DEPARTMENT_CREATE . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 添加部门
     * @param array $params 参数：https://work.weixin.qq.com/api/doc/90000/90135/90205
     *              id            是    部门id，32位整型，指定时必须大于1。若不填该参数，将自动生成id
     *              name        否    部门名称。同一个层级的部门名称不能重复。长度限制为1~32个字符，字符不能包括\:?”<>｜
     *              name_en        否    英文名称。同一个层级的部门名称不能重复。需要在管理后台开启多语言支持才能生效。长度限制为1~32个字符，字符不能包括\:?”<>｜
     *              parentid    否    父部门id，32位整型
     *              order        否    在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
     * @return mixed
     * @throws MessageException
     * @Date: 2020/10/19 17:57
     * @author: hug-code
     */
    public function updateDepartment(array $params = [])
    {
        $requestUrl = self::BASE_URL . self::DEPARTMENT_UPDATE . '?access_token=' . $this->access_token;
        return HttpRequest::instance()->post($requestUrl, json_encode($params))->toArray();
    }

    /**
     * @desc: 删除部门
     * @param string $id
     * @return mixed
     * @throws MessageException
     * @author: hug-code
     * @Date: 2020/10/19 17:54
     */
    public function deleteDepartment($id = null)
    {
        return HttpRequest::instance()->get(self::BASE_URL . self::DEPARTMENT_DELETE, [
            'access_token' => $this->access_token,
            'id'           => $id,
        ])->toArray();
    }

}
