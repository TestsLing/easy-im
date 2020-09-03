<?php

namespace EasyIM\TencentIM\Kernel\Constant;

/**
 * Class GroupConstant
 *
 * @package EasyIM\TencentIM\Kernel\Constant
 * @author  yingzhan <519203699@qq.com>
 *
 */
class GroupConstant
{
    /*
    |--------------------------------------------------------------------------
    | Group Type
    |--------------------------------------------------------------------------
    */

    /**
     * 即 Work，好友工作群
     */
    public const PRIVATE = 'Private';

    /**
     * 陌生人社交群
     */
    public const PUBLIC = 'Public';

    /**
     * 即 Meeting，会议群
     */
    public const CHAT_ROOM = 'ChatRoom';

    /**
     * 直播群
     */
    public const AV_CHAT_ROOM = 'AVChatRoom';

    public const B_CHAT_ROOM = 'BChatRoom';

    /*
    |--------------------------------------------------------------------------
    | ApplyJoin Type
    |--------------------------------------------------------------------------
    */

    /**
     * 自由加入
     */
    public const FREE_ACCESS = 'FreeAccess';

    /**
     * 需要验证
     */
    public const NEED_PERMISSION = 'NeedPermission';

    /**
     * 禁止加群
     */
    public const DISABLE_APPLY = 'DisableApply';


    /*
    |--------------------------------------------------------------------------
    | ShutUpAll Type
    |--------------------------------------------------------------------------
    */

    /**
     * 开启
     */
    public const ON = 'On';

    /**
     * 关闭
     */
    public const OFF = 'Off';

    /*
    |--------------------------------------------------------------------------
    | Role Type
    |--------------------------------------------------------------------------
    */

    /**
     * 设置管理员
     */
    public const ADMIN = 'Admin';

    /**
     * 取消管理员
     */
    public const MEMBER = 'Member';

    /*
    |--------------------------------------------------------------------------
    | MsgFlag Type
    |--------------------------------------------------------------------------
    */

    /**
     * 接收并提示消息
     */
    public const ACCEPT_AND_NOTIFY = 'AcceptAndNotify';

    /**
     * 不接收也不提示消息
     */
    public const DISCARD = 'Discard';

    /**
     * 接收消息但不提示
     */
    public const ACCEPT_NOT_NOTIFY = 'AcceptNotNotify';
}
