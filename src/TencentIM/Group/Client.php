<?php

namespace EasyIM\TencentIM\Group;

use EasyIM\Kernel\Exceptions\InvalidArgumentException;
use EasyIM\TencentIM\Group\Attribute\AppDefinedDataAttr;
use EasyIM\TencentIM\Group\Attribute\MemberListAttr;

/**
 * Class Client
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 *
 */
class Client extends GroupBaseClient
{
    /**
     * Create Group.
     *
     * @param string                  $name
     * @param string                  $type
     * @param string|null             $owner
     * @param MemberListAttr|null     $members
     * @param string|null             $announcement
     * @param string|null             $intro
     * @param string|null             $faceUrl
     * @param string|null             $groupId
     * @param int|null                $count
     * @param string|null             $applyJoin
     * @param AppDefinedDataAttr|null $appDefined
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(
        string $name,
        string $type,
        string $owner = null,
        MemberListAttr $members = null,
        string $announcement = null,
        string $intro = null,
        string $faceUrl = null,
        string $groupId = null,
        int $count = null,
        string $applyJoin = null,
        AppDefinedDataAttr $appDefined = null
    ) {
        if (!\in_array($type, $this->allowTypes, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported type: '%s'", $type));
        }
        if ($applyJoin && !\in_array($applyJoin, $this->allowApplyJoin, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported applyJoin: '%s'", $applyJoin));
        }
        $params = [
            'Type' => $type,
            'Name' => $name
        ];
        $owner && $params['Owner_Account'] = $owner;
        $members && $params['MemberList'] = $members->transformToArray();
        $announcement && $params['Notification'] = $announcement;
        $intro && $params['Introduction'] = $intro;
        $faceUrl && $params['FaceUrl'] = $faceUrl;
        $groupId && $params['GroupId'] = $groupId;
        $count && $params['MaxMemberCount'] = $count;
        $applyJoin && $params['ApplyJoinOption'] = $applyJoin;
        $appDefined && $params['AppDefinedData'] = $appDefined->transformToArray();

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
     * @throws InvalidArgumentException
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
     * @param string                  $groupId
     * @param string|null             $name
     * @param string|null             $introduction
     * @param string|null             $notification
     * @param string|null             $faceUrl
     * @param int|null                $max
     * @param string|null             $applyJoin
     * @param AppDefinedDataAttr|null $appDefinedData
     * @param string|null             $shutUpAll
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws InvalidArgumentException
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
        string $applyJoin = null,
        AppDefinedDataAttr $appDefinedData = null,
        string $shutUpAll = null
    ) {
        if ($applyJoin && !\in_array($applyJoin, $this->allowApplyJoin, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported applyJoin: '%s'", $applyJoin));
        }
        if ($shutUpAll && !\in_array($shutUpAll, $this->shutUpAll, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported shutUpAll: '%s'", $shutUpAll));
        }
        $params['GroupId'] = $groupId;
        $name && $params['Name'] = $name;
        $introduction && $params['Introduction'] = $introduction;
        $notification && $params['Notification'] = $notification;
        $faceUrl && $params['FaceUrl'] = $faceUrl;
        $max && $params['MaxMemberNum'] = $max;
        $applyJoin && $params['ApplyJoinOption'] = $applyJoin;
        $appDefinedData && $params['AppDefinedData'] = $appDefinedData;
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
