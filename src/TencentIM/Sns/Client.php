<?php

namespace EasyIM\TencentIM\Sns;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\ParameterList;
use EasyIM\TencentIM\Sns\Parameter\UpdateFriendParameter;

/**
 * Class Client
 *
 * @package EasyIM\TencentIM\Sns
 * @author  longing <hacksmile@126.com>
 */
class Client extends BaseClient
{
    /**
     *
     * @param string $fromAccount
     * @param array  $toAccount
     * @param array  $tagList
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFriends(string $fromAccount, array $toAccount, array $tagList)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'TagList' => $tagList,
        ];

        return $this->httpPostJson('sns/friend_get_list', $params);
    }


    /**
     *
     * @param string   $fromAccount
     * @param int      $startIndex
     * @param int|null $standardSequence
     * @param int|null $customSequence
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFriendList(string $fromAccount, int $startIndex = 0, int $standardSequence = null, int $customSequence = null)
    {
        $params = [
            'From_Account' => $fromAccount,
            'StartIndex' => $startIndex,
        ];

        $standardSequence && $params['StandardSequence'] = $standardSequence;
        $customSequence && $params['CustomSequence'] = $customSequence;

        return $this->httpPostJson('sns/friend_get', $params);
    }

    /**
     *
     * @param string $fromAccount
     * @param array  $toAccount
     * @param string $checkType
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkFriend(string $fromAccount, array $toAccount, string $checkType = 'CheckResult_Type_Both')
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'CheckType' => $checkType
        ];

        return $this->httpPostJson('sns/friend_check', $params);

    }

    /**
     *
     * @param string      $fromAccount
     * @param string|null $deleteType
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAllFriend(string $fromAccount, string $deleteType = 'Delete_Type_Both')
    {
        $params = [
            'From_Account' => $fromAccount,
            'DeleteType' => $deleteType
        ];

        return $this->httpPostJson('sns/friend_delete_all', $params);

    }


    /**
     *
     * @param string      $fromAccount
     * @param array       $toAccount
     * @param string|null $deleteType
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteFriend(string $fromAccount, array $toAccount, string $deleteType = 'Delete_Type_Both')
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'DeleteType' => $deleteType
        ];

        return $this->httpPostJson('sns/friend_delete', $params);
    }


    /**
     *
     * @param string                $fromAccount
     * @param UpdateFriendParameter $updateFriendItemAttr
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateFriend(string $fromAccount, UpdateFriendParameter $updateFriendItemAttr)
    {
        $params = [
            'From_Account' => $fromAccount,
            'UpdateItem' => [$updateFriendItemAttr->transformToArray()]
        ];

        return $this->httpPostJson('sns/friend_update', $params);
    }


    /**
     *
     * @param string        $fromAccount
     * @param ParameterList $addFriendAttr
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importFriend(string $fromAccount, ParameterList $addFriendAttr)
    {
        $params = [
            'From_Account' => $fromAccount,
            'AddFriendItem' => $addFriendAttr->transformParameterToArray()
        ];

        return $this->httpPostJson('sns/friend_import', $params);
    }


    /**
     *
     * @param string        $fromAccount
     * @param ParameterList $addFriendAttr
     * @param string        $addType
     * @param int           $forceAddFlags
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addFriend(
        string $fromAccount,
        ParameterList $addFriendAttr,
        string $addType = 'Add_Type_Both',
        int $forceAddFlags = 0
    ) {

        $params = [
            'From_Account' => $fromAccount,
            'AddType' => $addType,
            'ForceAddFlags' => $forceAddFlags,
            'AddFriendItem' => $addFriendAttr->transformParameterToArray()
        ];

        return $this->httpPostJson('sns/friend_add', $params);
    }


}
