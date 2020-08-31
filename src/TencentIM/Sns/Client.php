<?php

namespace EasyIM\TencentIM\Sns;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\ParameterList;
use EasyIM\Kernel\Support\Arr;
use EasyIM\TencentIM\Kernel\Constant\SnsConstant;
use EasyIM\TencentIM\Sns\Parameter\AddFriendParameter;
use EasyIM\TencentIM\Sns\Parameter\ImportFriendParameter;
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
     * get Friends.
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
     * get Friend List.
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

        Arr::setNotNullValue($params, 'StandardSequence', $standardSequence);
        Arr::setNotNullValue($params, 'CustomSequence', $customSequence);

        return $this->httpPostJson('sns/friend_get', $params);
    }

    /**
     * check Friend.
     *
     * @param string $fromAccount
     * @param array  $toAccount
     * @param string $checkType
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkFriend(string $fromAccount, array $toAccount, string $checkType = SnsConstant::CHECK_RESULT_TYPE_BOTH)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'CheckType' => $checkType
        ];

        return $this->httpPostJson('sns/friend_check', $params);

    }

    /**
     * delete All Friend.
     *
     * @param string      $fromAccount
     * @param string|null $deleteType
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAllFriend(string $fromAccount, string $deleteType = SnsConstant::DELETE_TYPE_BOTH)
    {
        $params = [
            'From_Account' => $fromAccount,
            'DeleteType' => $deleteType
        ];

        return $this->httpPostJson('sns/friend_delete_all', $params);

    }


    /**
     * delete Friend.
     *
     * @param string      $fromAccount
     * @param array       $toAccount
     * @param string|null $deleteType
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteFriend(string $fromAccount, array $toAccount, string $deleteType = SnsConstant::DELETE_TYPE_BOTH)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'DeleteType' => $deleteType
        ];

        return $this->httpPostJson('sns/friend_delete', $params);
    }


    /**
     * update Friend.
     *
     * @param string                $fromAccount
     * @param UpdateFriendParameter ...$updateFriendParameters
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateFriend(string $fromAccount, UpdateFriendParameter ...$updateFriendParameters)
    {

        $params = [
            'From_Account' => $fromAccount,
            'UpdateItem' => \parameterList(...$updateFriendParameters)()
        ];

        return $this->httpPostJson('sns/friend_update', $params);
    }


    /**
     * import Friend.
     *
     * @param string                $fromAccount
     * @param ImportFriendParameter ...$importFriendParameters
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importFriend(string $fromAccount, ImportFriendParameter ...$importFriendParameters)
    {
        $params = [
            'From_Account' => $fromAccount,
            'AddFriendItem' => \parameterList(...$importFriendParameters)()
        ];

        return $this->httpPostJson('sns/friend_import', $params);
    }


    /**
     * add Friend.
     *
     * @param string               $fromAccount
     * @param string               $addType
     * @param int                  $forceAddFlags
     *
     * @param AddFriendParameter[] $addFriendParameters
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addFriend(
        string $fromAccount,
        string $addType = SnsConstant::ADD_TYPE_BOTH,
        int $forceAddFlags = SnsConstant::NORMAL_ADD_FRIEND,
        AddFriendParameter ...$addFriendParameters
    ) {

        $params = [
            'From_Account' => $fromAccount,
            'AddType' => $addType,
            'ForceAddFlags' => $forceAddFlags,
            'AddFriendItem' => \parameterList(...$addFriendParameters)()
        ];

        return $this->httpPostJson('sns/friend_add', $params);
    }


}
