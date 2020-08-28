<?php


namespace EasyIM\TencentIM\Kernel\Constant;

/**
 * Class SingleChatConstant
 *
 * @package EasyIM\TencentIM\Kernel\Constant
 * @author  longing <hacksmile@126.com>
 */
class SingleChatConstant
{

    /*
    |--------------------------------------------------------------------------
    | 实时消息导入消息
    |--------------------------------------------------------------------------
    */

    /**
     * 实时消息导入，消息加入未读计数
     */
    const SYNC_FROM_OLD_SYSTEM_COUNT = 1;

    /**
     * 历史消息导入，消息不计入未读
     */
    const SYNC_FROM_OLD_SYSTEM_UN_COUNT = 2;

    /*
    |--------------------------------------------------------------------------
    | 单聊消息同步
    |--------------------------------------------------------------------------
    */

    /**
     * 把消息同步到 From_Account
     */
    const SYNC_OTHER_MACHINE = 1;

    /**
     * 消息不同步至 From_Account
     */
    const UN_SYNC_OTHER_MACHINE = 2;

}
