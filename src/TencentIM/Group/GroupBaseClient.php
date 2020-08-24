<?php


namespace EasyIM\TencentIM\Group;


use EasyIM\Kernel\BaseClient;

/**
 * Class GroupBaseClient
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 */
class GroupBaseClient extends BaseClient
{
    protected $allowTypes     = ['Private', 'Public', 'ChatRoom', 'AVChatRoom', 'BChatRoom'];
    protected $allowApplyJoin = ['FreeAccess', 'NeedPermission', 'DisableApply'];
    protected $silence        = [0, 1];
    protected $withHuge       = [0, 1];
    protected $withNoActive   = [0, 1];
    protected $onlineOnlyFlag = [0, 1];
    protected $shutUpAll      = ['On', 'Off'];
    protected $role           = ['Admin', 'Member'];
    protected $msgFlag        = ['AcceptAndNotify', 'Discard', 'AcceptNotNotify'];
}
