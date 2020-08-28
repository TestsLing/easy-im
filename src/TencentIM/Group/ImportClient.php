<?php


namespace EasyIM\TencentIM\Group;


use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Exceptions\InvalidConfigException;
use EasyIM\Kernel\ParameterList;
use EasyIM\Kernel\Support\Arr;
use EasyIM\Kernel\Support\Collection;
use EasyIM\TencentIM\Group\Parameter\Import\ImportMemberParameter;
use EasyIM\TencentIM\Group\Parameter\Import\ImportMsgListParameter;
use EasyIM\TencentIM\Kernel\Constant\GroupConstant;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ImportClient
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 *
 */
class ImportClient extends BaseClient
{
    /**
     * Import group basic data.
     *
     * @param string             $name
     * @param string             $type
     * @param string|null        $owner
     * @param string|null        $groupId
     * @param string|null        $announcement
     * @param string|null        $intro
     * @param string|null        $faceUrl
     * @param int|null           $count
     * @param string|null        $applyJoin
     * @param ParameterList|null $appDefined
     * @param int|null           $createTime
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function importGroup(
        string $name,
        string $type = GroupConstant::PUBLIC,
        string $owner = null,
        string $groupId = null,
        string $announcement = null,
        string $intro = null,
        string $faceUrl = null,
        int $count = null,
        string $applyJoin = null,
        ParameterList $appDefined = null,
        int $createTime = null
    ) {
        $params = [
            'Name' => $name,
            'Type' => $type
        ];
        Arr::setNotNullValue($params, 'Owner_Account', $owner);
        Arr::setNotNullValue($params, 'GroupId', $groupId);
        Arr::setNotNullValue($params, 'Notification', $announcement);
        Arr::setNotNullValue($params, 'Introduction', $intro);
        Arr::setNotNullValue($params, 'FaceUrl', $faceUrl);
        Arr::setNotNullValue($params, 'MaxMemberCount', $count);
        Arr::setNotNullValue($params, 'ApplyJoinOption', $applyJoin);
        Arr::setNotNullValue($params, 'AppDefinedData', $appDefined());
        Arr::setNotNullValue($params, 'CreateTime', $createTime);

        return $this->httpPostJson('group_open_http_svc/import_group', $params);
    }

    /**
     * Import group message.
     *
     * @param string                 $groupId
     * @param ImportMsgListParameter ...$msgListParameters
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function importGroupMsg(string $groupId, ImportMsgListParameter ...$msgListParameters)
    {
        $params = [
            'GroupId' => $groupId,
            'MsgList' => parameterList(...$msgListParameters)()
        ];

        return $this->httpPostJson('group_open_http_svc/import_group_msg', $params);
    }

    /**
     * Import group members.
     *
     * @param string                $groupId
     * @param ImportMemberParameter ...$memberParameters
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function importGroupMember(string $groupId, ImportMemberParameter ...$memberParameters)
    {
        $params = [
            'GroupId'    => $groupId,
            'MemberList' => parameterList(...$memberParameters)()
        ];

        return $this->httpPostJson('group_open_http_svc/import_group_member', $params);
    }
}
