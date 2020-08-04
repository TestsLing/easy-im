<?php


namespace EasyIM\TencentIM\Sns;


use EasyIM\TencentIM\Kernel\IMBaseClient;

/**
 * Class GroupClient
 *
 * @package EasyIM\TencentIM\Sns
 * @author  longing <hacksmile@126.com>
 */
class GroupClient extends IMBaseClient
{

    /**
     * Add group.
     *
     * @param string     $fromAccount
     * @param array      $groupName
     * @param array|null $toAccount
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addGroup(string $fromAccount, array $groupName, array $toAccount = null)
    {
        $params = [
            'From_Account' => $fromAccount,
            'GroupName' => $groupName
        ];

        $toAccount && $params['To_Account'] = $toAccount;

        return $this->httpPostJson('sns/group_add', $params);
    }


    /**
     * Delete group.
     *
     * @param string $fromAccount
     * @param array  $groupName
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delGroup(string $fromAccount, array $groupName)
    {
        $params = [
            'From_Account' => $fromAccount,
            'GroupName' => $groupName
        ];

        return $this->httpPostJson('sns/group_delete', $params);
    }



}
