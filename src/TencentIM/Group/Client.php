<?php

namespace EasyIM\TencentIM\Group;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\ParameterList;
use EasyIM\TencentIM\Kernel\Constant\GroupConstant;

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
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
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
        string $applyJoin = GroupConstant::NEED_PERMISSION,
        ParameterList $appDefined = null
    ) {
        $params = [
            'Type' => $type,
            'Name' => $name
        ];
        $owner && $params['Owner_Account'] = $owner;
        $members && $params['MemberList'] = $members();
        $announcement && $params['Notification'] = $announcement;
        $intro && $params['Introduction'] = $intro;
        $faceUrl && $params['FaceUrl'] = $faceUrl;
        $groupId && $params['GroupId'] = $groupId;
        $count && $params['MaxMemberCount'] = $count;
        $applyJoin && $params['ApplyJoinOption'] = $applyJoin;
        $appDefined && $params['AppDefinedData'] = $appDefined();

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
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(
        array $groupIds,
        array $groupBaseInfo = null,
        array $memberInfo = null,
        array $appDefinedData = null,
        array $appDefinedDataMember = null
    ) {
        $params['GroupIdList'] = $groupIds;
        $groupBaseInfo && $params['ResponseFilter']['GroupBaseInfoFilter'] = $groupBaseInfo;
        $memberInfo && $params['ResponseFilter']['MemberInfoFilter'] = $groupBaseInfo;
        $appDefinedData && $params['ResponseFilter']['AppDefinedDataFilter_Group'] = $groupBaseInfo;
        $appDefinedDataMember && $params['ResponseFilter']['AppDefinedDataFilter_GroupMember'] = $groupBaseInfo;

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
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function modify(
        string $groupId,
        string $name = null,
        string $introduction = null,
        string $notification = null,
        string $faceUrl = null,
        int $max = null,
        string $applyJoin = GroupConstant::NEED_PERMISSION,
        ParameterList $appDefinedData = null,
        string $shutUpAll = null
    ) {
        $params['GroupId'] = $groupId;
        $name && $params['Name'] = $name;
        $introduction && $params['Introduction'] = $introduction;
        $notification && $params['Notification'] = $notification;
        $faceUrl && $params['FaceUrl'] = $faceUrl;
        $max && $params['MaxMemberNum'] = $max;
        $applyJoin && $params['ApplyJoinOption'] = $applyJoin;
        $appDefinedData && $params['AppDefinedData'] = $appDefinedData();
        $shutUpAll && $params['ShutUpAllMember'] = $shutUpAll;

        return $this->httpPostJson('group_open_http_svc/modify_group_base_info', $params);
    }

    /**
     * Disband group.
     *
     * @param string $groupId
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroy(string $groupId)
    {
        $params = [
            'GroupId' => $groupId
        ];

        return $this->httpPostJson('group_open_http_svc/destroy_group', $params);
    }
}
