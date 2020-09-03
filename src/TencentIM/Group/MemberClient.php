<?php

namespace EasyIM\TencentIM\Group;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Exceptions\InvalidArgumentException;
use EasyIM\Kernel\Exceptions\InvalidConfigException;
use EasyIM\Kernel\ParameterList;
use EasyIM\Kernel\Support\Arr;
use EasyIM\Kernel\Support\Collection;
use EasyIM\TencentIM\Group\Parameter\Member\ResponseFilterParameter;
use EasyIM\TencentIM\Kernel\Constant\GroupConstant;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class MemberClient
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 *
 */
class MemberClient extends BaseClient
{
    /**
     * Get group member details.
     *
     * @param string     $groupId
     * @param int   $limit
     * @param int   $offset
     * @param array $memberInfo
     * @param array $memberRole
     * @param array $appDefinedDataMember
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getMember(
        string $groupId,
        int $limit = 100,
        int $offset = 0,
        array $memberInfo = [],
        array $memberRole = [],
        array $appDefinedDataMember = []
    ) {
        $params['GroupId'] = $groupId;
        Arr::setNotNullValue($params, 'MemberInfoFilter', $memberInfo);
        Arr::setNotNullValue($params, 'MemberRoleFilter', $memberRole);
        Arr::setNotNullValue($params, 'AppDefinedDataFilter_GroupMember', $appDefinedDataMember);
        Arr::setNotNullValue($params, 'Limit', $limit);
        Arr::setNotNullValue($params, 'Offset', $offset);

        return $this->httpPostJson('group_open_http_svc/get_group_member_info', $params);
    }

    /**
     * Increase group members.
     *
     * @param string        $groupId
     * @param ParameterList $memberList  ...MemberListParameter
     * @param int      $silence
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function addMember(string $groupId, ParameterList $memberList, int $silence = 0)
    {
        $params = [
            'GroupId' => $groupId,
            'MemberList' => $memberList->transformParameterToArray()
        ];
        Arr::setNotNullValue($params, 'Silence', $silence);

        return $this->httpPostJson('group_open_http_svc/add_group_member', $params);
    }

    /**
     * Delete group members.
     *
     * @param string      $groupId
     * @param array       $memberList
     * @param int    $silence
     * @param string|null $reason
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function deleteMember(string $groupId, array $memberList, int $silence = 0, string $reason = null)
    {
        $params = [
            'GroupId' => $groupId,
            'MemberToDel_Account' => $memberList
        ];
        Arr::setNotNullValue($params, 'Silence', $silence);
        Arr::setNotNullValue($params, 'Reason', $reason);

        return $this->httpPostJson('group_open_http_svc/delete_group_member', $params);
    }

    /**
     * Modify group member information.
     *
     * @param string             $groupId
     * @param string             $memberAccount
     * @param string|null        $role
     * @param string        $msgFlag
     * @param string|null        $nameCard
     * @param ParameterList|null $appDefinedDataMember ...CommonParameter
     * @param int|null           $shuntUpTime
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     * @throws InvalidArgumentException
     */
    public function modifyMember(
        string $groupId,
        string $memberAccount,
        string $role = null,
        string $msgFlag = GroupConstant::ACCEPT_AND_NOTIFY,
        string $nameCard = null,
        ParameterList $appDefinedDataMember = null,
        int $shuntUpTime = null
    ) {
        $params = [
            'GroupId' => $groupId,
            'Member_Account' => $memberAccount
        ];
        Arr::setNotNullValue($params, 'Role', $role);
        Arr::setNotNullValue($params, 'MsgFlag', $msgFlag);
        Arr::setNotNullValue($params, 'NameCard', $nameCard);
        Arr::setNotNullValue($params, 'AppMemberDefinedData', $appDefinedDataMember && $appDefinedDataMember());
        Arr::setNotNullValue($params, 'ShutUpTime', $shuntUpTime);

        return $this->httpPostJson('group_open_http_svc/modify_group_member_info', $params);
    }

    /**
     * Get the group the user joined.
     *
     * @param string                       $memberAccount
     * @param int                     $withHuge
     * @param int                     $withNoActive
     * @param int                     $limit
     * @param int                     $offset
     * @param string|null                  $type
     * @param ResponseFilterParameter|null $filter
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getJoined(
        string $memberAccount,
        int $withHuge = 0,
        int $withNoActive = 0,
        int $limit = 10,
        int $offset = 0,
        string $type = null,
        ResponseFilterParameter $filter = null
    ) {
        $params = [
            'Member_Account' => $memberAccount
        ];
        Arr::setNotNullValue($params, 'WithHugeGroups', $withHuge);
        Arr::setNotNullValue($params, 'WithNoActiveGroups', $withNoActive);
        Arr::setNotNullValue($params, 'Limit', $limit);
        Arr::setNotNullValue($params, 'Offset', $offset);
        Arr::setNotNullValue($params, 'GroupType', $type);
        Arr::setNotNullValue($params, 'ResponseFilter', $filter && $filter->transformToArray());

        return $this->httpPostJson('group_open_http_svc/get_joined_group_list', $params);
    }

    /**
     * Query the user's identity in the group.
     *
     * @param string $groupId
     * @param array  $memberAccount
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getRole(string $groupId, array $memberAccount)
    {
        $params = [
            'GroupId' => $groupId,
            'User_Account' => $memberAccount
        ];

        return $this->httpPostJson('group_open_http_svc/get_role_in_group', $params);
    }
}
