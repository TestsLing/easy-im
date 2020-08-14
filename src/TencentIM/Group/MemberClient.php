<?php


namespace EasyIM\TencentIM\Group;


use EasyIM\Kernel\Exceptions\InvalidArgumentException;
use EasyIM\TencentIM\Group\Attribute\AppDefinedDataMemberAttr;
use EasyIM\TencentIM\Group\Attribute\MemberListAttr;
use EasyIM\TencentIM\Group\Attribute\ResponseFilterItemAttr;

/**
 * Class MemberClient
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 */
class MemberClient extends GroupBaseClient
{
    /**
     * Get group member details.
     *
     * @param string     $groupId
     * @param int|null   $limit
     * @param int|null   $offset
     * @param array|null $memberInfo
     * @param array|null $memberRole
     * @param array|null $appDefinedDataMember
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMember(
        string $groupId,
        int $limit = null,
        int $offset = null,
        array $memberInfo = null,
        array $memberRole = null,
        array $appDefinedDataMember = null
    ) {
        $params['GroupId'] = $groupId;
        $memberInfo && $params['MemberInfoFilter'] = $memberInfo;
        $memberRole && $params['MemberRoleFilter'] = $memberRole;
        $appDefinedDataMember && $params['AppDefinedDataFilter_GroupMember'] = $appDefinedDataMember;
        $limit && $params['Limit'] = $limit;
        $offset && $params['Offset'] = $offset;

        return $this->httpPostJson('group_open_http_svc/get_group_member_info', $params);
    }

    /**
     * Increase group members.
     *
     * @param string         $groupId
     * @param MemberListAttr $memberList
     * @param int|null       $silence
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addMember(string $groupId, MemberListAttr $memberList, int $silence = null)
    {
        if ($silence && !\in_array($silence, $this->silence, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported silence: '%s'", $silence));
        }
        $params = [
            'GroupId'    => $groupId,
            'MemberList' => $memberList->transformToArray()
        ];
        $silence && $params['Silence'] = $silence;

        return $this->httpPostJson('group_open_http_svc/add_group_member', $params);
    }

    /**
     * Delete group members.
     *
     * @param string      $groupId
     * @param array       $memberList
     * @param int|null    $silence
     * @param string|null $reason
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteMember(string $groupId, array $memberList, int $silence = null, string $reason = null)
    {
        if ($silence && !\in_array($silence, $this->silence, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported silence: '%s'", $silence));
        }
        $params = [
            'GroupId'             => $groupId,
            'MemberToDel_Account' => $memberList
        ];
        $silence && $params['Silence'] = $silence;
        $reason && $params['Reason'] = $reason;

        return $this->httpPostJson('group_open_http_svc/delete_group_member', $params);
    }

    /**
     * Modify group member information.
     *
     * @param string                   $groupId
     * @param string                   $memberAccount
     * @param string|null              $role
     * @param string|null              $msgFlag
     * @param string|null              $nameCard
     * @param AppDefinedDataMemberAttr $appDefinedDataMember
     * @param int|null                 $shuntUpTime
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws InvalidArgumentException
     */
    public function modifyMember(
        string $groupId,
        string $memberAccount,
        string $role = null,
        string $msgFlag = null,
        string $nameCard = null,
        AppDefinedDataMemberAttr $appDefinedDataMember = null,
        int $shuntUpTime = null
    ) {
        if ($role && !\in_array($role, $this->role, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported role: '%s'", $role));
        }
        if ($msgFlag && !\in_array($msgFlag, $this->msgFlag, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported msgFlag: '%s'", $msgFlag));
        }
        $params = [
            'GroupId'        => $groupId,
            'Member_Account' => $memberAccount
        ];
        $role && $params['Role'] = $role;
        $msgFlag && $params['MsgFlag'] = $msgFlag;
        $nameCard && $params['NameCard'] = $nameCard;
        $appDefinedDataMember && $params['AppMemberDefinedData'] = $appDefinedDataMember->transformToArray();
        $shuntUpTime && $params['ShutUpTime'] = $shuntUpTime;

        return $this->httpPostJson('group_open_http_svc/modify_group_member_info', $params);
    }

    /**
     * Get the group the user joined.
     *
     * @param string                      $memberAccount
     * @param int|null                    $withHuge
     * @param int|null                    $withNoActive
     * @param int|null                    $limit
     * @param int|null                    $offset
     * @param string|null                 $type
     * @param ResponseFilterItemAttr|null $filter
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getJoined(
        string $memberAccount,
        int $withHuge = null,
        int $withNoActive = null,
        int $limit = null,
        int $offset = null,
        string $type = null,
        ResponseFilterItemAttr $filter = null
    ) {
        if ($withHuge && !\in_array($withHuge, $this->withHuge, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported withHuge: '%s'", $withHuge));
        }
        if ($withNoActive && !\in_array($withNoActive, $this->withNoActive, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported withNoActive: '%s'", $withNoActive));
        }
        if ($type && !\in_array($type, $this->allowTypes, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported type: '%s'", $type));
        }
        $params = [
            'Member_Account' => $memberAccount
        ];
        $withHuge && $params['WithHugeGroups'] = $withHuge;
        $withNoActive && $params['WithNoActiveGroups'] = $withNoActive;
        $limit && $params['Limit'] = $limit;
        $offset && $params['Offset'] = $offset;
        $type && $params['GroupType'] = $type;
        $filter && $params['ResponseFilter'] = $filter->transformToArray();

        return $this->httpPostJson('group_open_http_svc/get_joined_group_list', $params);
    }

    /**
     * Query the user's identity in the group.
     *
     * @param string $groupId
     * @param array  $memberAccount
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRole(string $groupId, array $memberAccount)
    {
        $params = [
            'GroupId'      => $groupId,
            'User_Account' => $memberAccount
        ];

        return $this->httpPostJson('group_open_http_svc/get_role_in_group', $params);
    }
}