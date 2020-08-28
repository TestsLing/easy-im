<?php

namespace EasyIM\TencentIM\Account;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Support\Arr;

/**
 * Class Client
 *
 * @package EasyIM\TencentIM\Account
 */
class Client extends BaseClient
{
    /**
     * Import a single account.
     *
     * @param string $id
     * @param string $name
     * @param string $avatar
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function accountImport(string $id, string $name = null, string $avatar = null)
    {
        $params = [
            'Identifier' => $id
        ];

        $name && $params['Nick'] = $name;
        $avatar && $params['FaceUrl'] = $avatar;

        return $this->httpPostJson('im_open_login_svc/account_import', $params);
    }

    /**
     * Import multiple accounts.
     *
     * @param array $accounts
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function multiAccountImport(array $accounts)
    {
        $params = [
            'Accounts' => $accounts
        ];

        return $this->httpPostJson('im_open_login_svc/multiaccount_import', $params);
    }

    /**
     * Delete Account.
     *
     * @param array $accounts
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function accountDelete(array $accounts)
    {
        $accountList = [];

        foreach ($accounts as $user) {
            $accountList[]['UserID'] = $user;
        }

        unset($user);

        $params = [
            'DeleteItem' => $accountList
        ];

        return $this->httpPostJson('im_open_login_svc/account_delete', $params);
    }

    /**
     * Inquiry account number.
     *
     * @param array $accounts
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function accountCheck(array $accounts)
    {
        $accountList = [];

        foreach ($accounts as $user) {
            $accountList[]['UserID'] = $user;
        }

        unset($user);

        $params = [
            'CheckItem' => $accountList
        ];

        return $this->httpPostJson('im_open_login_svc/account_check', $params);
    }

    /**
     * Invalid account login status.
     *
     * @param string $id
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function kick(string $id)
    {
        $params = [
            'Identifier' => $id
        ];

        return $this->httpPostJson('im_open_login_svc/kick', $params);
    }

    /**
     * Query account online status.
     *
     * @param array $accounts
     * @param int   $isNeedDetail
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryState(array $accounts, int $isNeedDetail = 1)
    {
        $params = [
            'To_Account'   => $accounts,
            'IsNeedDetail' => $isNeedDetail
        ];

        return $this->httpPostJson('openim/querystate', $params);
    }
}
