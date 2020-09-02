<?php


namespace EasyIM\TencentIM\Group;


use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Exceptions\InvalidConfigException;
use EasyIM\Kernel\ParameterList;
use EasyIM\Kernel\Support\Arr;
use EasyIM\Kernel\Support\Collection;
use EasyIM\TencentIM\Group\Parameter\Base\CommonParameter;
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
     * @param string|null        $ownerAccount
     * @param string|null        $groupId
     * @param string|null        $notification
     * @param string|null        $introduction
     * @param string|null        $faceUrl
     * @param int|null           $maxMemberCount
     * @param string|null        $applyJoinOption
     * @param ParameterList|null $appDefined
     * @param int|null           $createTime
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function importGroup(
        string $name,
        string $type = GroupConstant::PUBLIC,
        string $ownerAccount = null,
        string $groupId = null,
        string $notification = null,
        string $introduction = null,
        string $faceUrl = null,
        int $maxMemberCount = null,
        string $applyJoinOption = null,
        ParameterList $appDefined = null,
        int $createTime = null
    ) {
        $params = [
            'Name' => $name,
            'Type' => $type
        ];
        Arr::setNotNullValue($params, 'Owner_Account', $ownerAccount);
        Arr::setNotNullValue($params, 'GroupId', $groupId);
        Arr::setNotNullValue($params, 'Notification', $notification);
        Arr::setNotNullValue($params, 'Introduction', $introduction);
        Arr::setNotNullValue($params, 'FaceUrl', $faceUrl);
        Arr::setNotNullValue($params, 'MaxMemberCount', $maxMemberCount);
        Arr::setNotNullValue($params, 'ApplyJoinOption', $applyJoinOption);
        Arr::setNotNullValue($params, 'AppDefinedData', $appDefined && $appDefined());
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
