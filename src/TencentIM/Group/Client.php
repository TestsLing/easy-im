<?php

namespace EasyIM\TencentIM\Group;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Exceptions\InvalidConfigException;
use EasyIM\Kernel\ParameterList;
use EasyIM\Kernel\Support\Arr;
use EasyIM\Kernel\Support\Collection;
use EasyIM\TencentIM\Group\Parameter\Base\CommonParameter;
use EasyIM\TencentIM\Group\Parameter\Member\MemberListParameter;
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
     * @param string|null        $introduction
     * @param string|null        $notification
     * @param string|null        $faceUrl
     * @param string             $type
     * @param string|null        $ownerAccount
     * @param string|null        $groupId
     * @param int|null           $maxMemberCount
     * @param string|null        $applyJoinOption
     * @param ParameterList<MemberListParameter>|null $memberList
     * @param ParameterList<CommonParameter>|null $appDefinedData
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function create(
        string $name,
        string $introduction = null,
        string $notification = null,
        string $faceUrl = null,
        string $type = GroupConstant::PUBLIC,
        string $ownerAccount = null,
        int $maxMemberCount = null,
        ParameterList $memberList = null,
        ParameterList $appDefinedData = null,
        string $applyJoinOption = GroupConstant::FREE_ACCESS,
        string $groupId = null
    ) {
        $params = [
            'Type' => $type,
            'Name' => $name
        ];
        Arr::setNotNullValue($params, 'Owner_Account', $ownerAccount);
        Arr::setNotNullValue($params, 'MemberList', $memberList && $memberList());
        Arr::setNotNullValue($params, 'Notification', $notification);
        Arr::setNotNullValue($params, 'Introduction', $introduction);
        Arr::setNotNullValue($params, 'FaceUrl', $faceUrl);
        Arr::setNotNullValue($params, 'GroupId', $groupId);
        Arr::setNotNullValue($params, 'MaxMemberCount', $maxMemberCount);
        Arr::setNotNullValue($params, 'ApplyJoinOption', $applyJoinOption);
        Arr::setNotNullValue($params, 'AppDefinedData', $appDefinedData && $appDefinedData());

        return $this->httpPostJson('group_open_http_svc/create_group', $params);
    }

    /**
     * Get group details.
     *
     * @param array      $groupIds
     * @param array|null $groupBaseInfoFilter
     * @param array|null $memberInfoFilter
     * @param array|null $appDefinedDataFilterGroup
     * @param array|null $appDefinedDataFilterGroupMember
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function get(
        array $groupIds,
        array $groupBaseInfoFilter = null,
        array $memberInfoFilter = null,
        array $appDefinedDataFilterGroup = null,
        array $appDefinedDataFilterGroupMember = null
    ) {
        $params['GroupIdList'] = $groupIds;
        Arr::setNotNullValue($params, 'ResponseFilter.GroupBaseInfoFilter', $groupBaseInfoFilter);
        Arr::setNotNullValue($params, 'ResponseFilter.MemberInfoFilter', $memberInfoFilter);
        Arr::setNotNullValue($params, 'ResponseFilter.AppDefinedDataFilter_Group', $appDefinedDataFilterGroup);
        Arr::setNotNullValue($params, 'ResponseFilter.AppDefinedDataFilter_GroupMember', $appDefinedDataFilterGroupMember);

        return $this->httpPostJson('group_open_http_svc/get_group_info', $params);
    }


    /**
     * Modify group basic data.
     * @param string             $groupId
     * @param string|null        $name
     * @param string|null        $introduction
     * @param string|null        $notification
     * @param string|null        $faceUrl
     * @param int|null           $maxMemberNum
     * @param string        $applyJoinOption
     * @param ParameterList<CommonParameter> |null $appDefinedData
     * @param string|null        $shutUpAll
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function modify(
        string $groupId,
        string $name = null,
        string $introduction = null,
        string $notification = null,
        string $faceUrl = null,
        int $maxMemberNum = null,
        string $shutUpAll = null,
        string $applyJoinOption = GroupConstant::FREE_ACCESS,
        ParameterList $appDefinedData = null
    ) {
        $params['GroupId'] = $groupId;
        Arr::setNotNullValue($params, 'Name', $name);
        Arr::setNotNullValue($params, 'Introduction', $introduction);
        Arr::setNotNullValue($params, 'Notification', $notification);
        Arr::setNotNullValue($params, 'FaceUrl', $faceUrl);
        Arr::setNotNullValue($params, 'MaxMemberNum', $maxMemberNum);
        Arr::setNotNullValue($params, 'ApplyJoinOption', $applyJoinOption);
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
