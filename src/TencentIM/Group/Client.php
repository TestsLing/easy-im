<?php

namespace EasyIM\TencentIM\Group;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Exceptions\InvalidConfigException;
use EasyIM\Kernel\ParameterList;
use EasyIM\Kernel\Support\Arr;
use EasyIM\Kernel\Support\Collection;
use EasyIM\TencentIM\Kernel\Constant\GroupConstant;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 *
 */
class Client extends BaseClient
{
    /**
     * Create Group.
     *
     * @param string             $name
     * @param string             $type
     * @param string|null        $owner
     * @param ParameterList|null $members
     * @param string|null        $announcement
     * @param string|null        $intro
     * @param string|null        $faceUrl
     * @param string|null        $groupId
     * @param int|null           $count
     * @param string|null        $applyJoin
     * @param ParameterList|null $appDefined
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function create(
        string $name,
        string $type = GroupConstant::PUBLIC,
        string $owner = null,
        ParameterList $members = null,
        string $announcement = null,
        string $intro = null,
        string $faceUrl = null,
        string $groupId = null,
        int $count = null,
        string $applyJoin = null,
        ParameterList $appDefined = null
    ) {
        $params = [
            'Type' => $type,
            'Name' => $name
        ];
        Arr::setNotNullValue($params, 'Owner_Account', $owner);
        Arr::setNotNullValue($params, 'MemberList', $members && $members());
        Arr::setNotNullValue($params, 'Notification', $announcement);
        Arr::setNotNullValue($params, 'Introduction', $intro);
        Arr::setNotNullValue($params, 'FaceUrl', $faceUrl);
        Arr::setNotNullValue($params, 'GroupId', $groupId);
        Arr::setNotNullValue($params, 'MaxMemberCount', $count);
        Arr::setNotNullValue($params, 'ApplyJoinOption', $applyJoin);
        Arr::setNotNullValue($params, 'AppDefinedData', $appDefined && $appDefined());

        return $this->httpPostJson('group_open_http_svc/create_group', $params);
    }

    /**
     * Get group details.
     *
     * @param array      $groupIds
     * @param array|null $groupBaseInfo
     * @param array|null $memberInfo
     * @param array|null $appDefinedData
     * @param array|null $appDefinedDataMember
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function get(
        array $groupIds,
        array $groupBaseInfo = null,
        array $memberInfo = null,
        array $appDefinedData = null,
        array $appDefinedDataMember = null
    ) {
        $params['GroupIdList'] = $groupIds;
        Arr::setNotNullValue($params, 'ResponseFilter.GroupBaseInfoFilter', $groupBaseInfo);
        Arr::setNotNullValue($params, 'ResponseFilter.MemberInfoFilter', $memberInfo);
        Arr::setNotNullValue($params, 'ResponseFilter.AppDefinedDataFilter_Group', $appDefinedData);
        Arr::setNotNullValue($params, 'ResponseFilter.AppDefinedDataFilter_GroupMember', $appDefinedDataMember);

        return $this->httpPostJson('group_open_http_svc/get_group_info', $params);
    }


    /**
     * Modify group basic data.
     *
     * @param string             $groupId
     * @param string|null        $name
     * @param string|null        $introduction
     * @param string|null        $notification
     * @param string|null        $faceUrl
     * @param int|null           $max
     * @param string|null        $applyJoin
     * @param ParameterList|null $appDefinedData
     * @param string|null        $shutUpAll
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function modify(
        string $groupId,
        string $name = null,
        string $introduction = null,
        string $notification = null,
        string $faceUrl = null,
        int $max = null,
        string $applyJoin = null,
        ParameterList $appDefinedData = null,
        string $shutUpAll = null
    ) {
        $params['GroupId'] = $groupId;
        Arr::setNotNullValue($params, 'Name', $name);
        Arr::setNotNullValue($params, 'Introduction', $introduction);
        Arr::setNotNullValue($params, 'Notification', $notification);
        Arr::setNotNullValue($params, 'FaceUrl', $faceUrl);
        Arr::setNotNullValue($params, 'MaxMemberNum', $max);
        Arr::setNotNullValue($params, 'ApplyJoinOption', $applyJoin);
        Arr::setNotNullValue($params, 'AppDefinedData', $appDefinedData && $appDefinedData());
        Arr::setNotNullValue($params, 'ShutUpAllMember', $shutUpAll);

        return $this->httpPostJson('group_open_http_svc/modify_group_base_info', $params);
    }

    /**
     * Disband group.
     *
     * @param string $groupId
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function destroy(string $groupId)
    {
        $params = [
            'GroupId' => $groupId
        ];

        return $this->httpPostJson('group_open_http_svc/destroy_group', $params);
    }
}
