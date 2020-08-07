<?php


namespace EasyIM\TencentIM\Group;


use EasyIM\TencentIM\Group\Attribute\AppDefinedDataAttr;
use EasyIM\TencentIM\Group\Attribute\ImportMemberItemAttr;
use EasyIM\TencentIM\Group\Attribute\MsgListItemAttr;

/**
 * Class ImportClient
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 */
class ImportClient extends GroupBaseClient
{
    /**
     * Import group basic data.
     *
     * @param string                  $name
     * @param string                  $type
     * @param string|null             $owner
     * @param string|null             $groupId
     * @param string|null             $announcement
     * @param string|null             $intro
     * @param string|null             $faceUrl
     * @param int|null                $count
     * @param string|null             $applyJoin
     * @param AppDefinedDataAttr|null $appDefined
     * @param int|null                $createTime
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importGroup(
        string $name,
        string $type,
        string $owner = null,
        string $groupId = null,
        string $announcement = null,
        string $intro = null,
        string $faceUrl = null,
        int $count = null,
        string $applyJoin = null,
        AppDefinedDataAttr $appDefined = null,
        int $createTime = null
    ) {
        $params = [
            'Name' => $name,
            'Type' => $type
        ];
        $owner && $params['Owner_Account'] = $owner;
        $groupId && $params['GroupId'] = $groupId;
        $announcement && $params['Notification'] = $announcement;
        $intro && $params['Introduction'] = $intro;
        $faceUrl && $params['FaceUrl'] = $faceUrl;
        $count && $params['MaxMemberCount'] = $count;
        $applyJoin && $params['ApplyJoinOption'] = $applyJoin;
        $appDefined && $params['AppDefinedData'] = $appDefined;
        $createTime && $params['CreateTime'] = $createTime;

        return $this->httpPostJson('group_open_http_svc/import_group', $params);
    }

    /**
     * Import group message.
     *
     * @param string          $groupId
     * @param MsgListItemAttr $msgList
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importGroupMsg(string $groupId, MsgListItemAttr $msgList)
    {
        $params = [
            'GroupId' => $groupId,
            'MsgList' => $msgList
        ];

        return $this->httpPostJson('group_open_http_svc/import_group_msg', $params);
    }

    /**
     * Import group members.
     *
     * @param string               $groupId
     * @param ImportMemberItemAttr $memberList
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importGroupMember(string $groupId, ImportMemberItemAttr $memberList)
    {
        $params = [
            'GroupId'    => $groupId,
            'MemberList' => $memberList
        ];

        return $this->httpPostJson('group_open_http_svc/import_group_member', $params);
    }
}