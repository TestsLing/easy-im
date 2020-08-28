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
    const PRIVATE = 'Private';

    /**
     * 陌生人社交群
     */
    const PUBLIC  = 'Public';

    /**
     * 即 Meeting，会议群
     */
    const CHAT_ROOM = 'ChatRoom';

    /**
     * 直播群
     */
    const AV_CHAT_ROOM = 'AVChatRoom';

    const B_CHAT_ROOM = 'BChatRoom';

    /*
    |--------------------------------------------------------------------------
    | ApplyJoin Type
    |--------------------------------------------------------------------------
    */

    /**
     * 自由加入
     */
    const FREE_ACCESS = 'FreeAccess';

    /**
     * 需要验证
     */
    const NEED_PERMISSION = 'NeedPermission';

    /**
     * 禁止加群
     */
    const DISABLE_APPLY = 'DisableApply';


    /*
    |--------------------------------------------------------------------------
    | ShutUpAll Type
    |--------------------------------------------------------------------------
    */

    /**
     * 开启
     */
    const ON = 'On';

    /**
     * 关闭
     */
    const OFF = 'Off';

    /*
    |--------------------------------------------------------------------------
    | Role Type
    |--------------------------------------------------------------------------
    */

    /**
     * 设置管理员
     */
    const ADMIN = 'Admin';

    /**
     * 取消管理员
     */
    const MEMBER = 'Member';

    /*
    |--------------------------------------------------------------------------
    | MsgFlag Type
    |--------------------------------------------------------------------------
    */

    /**
     * 接收并提示消息
     */
    const ACCEPT_AND_NOTIFY = 'AcceptAndNotify';

    /**
     * 不接收也不提示消息
     */
    const DISCARD = 'Discard';

    /**
     * 接收消息但不提示
     */
    const ACCEPT_NOT_NOTIFY = 'AcceptNotNotify';

}
