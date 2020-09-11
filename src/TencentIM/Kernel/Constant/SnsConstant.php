<?php

namespace EasyIM\TencentIM\Kernel\Constant;

/**
 * Class SnsConstant
 *
 * @package EasyIM\TencentIM\Kernel\Constant
 * @author  longing <hacksmile@126.com>
 */
class SnsConstant
{
    /*
    |--------------------------------------------------------------------------
    | 黑名单 校验模式
    |--------------------------------------------------------------------------
    */

    /**
     * 单向校验黑名单关系
     */
    public const BLACK_CHECK_RESULT_TYPE_SINGLE = 'BlackCheckResult_Type_Single';


    /**
     * 双向校验黑名单关系
     */
    public const BLACK_CHECK_RESULT_TYPE_BOTH = 'BlackCheckResult_Type_Both';


    /*
    |--------------------------------------------------------------------------
    | 好友 校验模式
    |--------------------------------------------------------------------------
    */

    /**
     * 双向校验好友关系
     */
    public const CHECK_RESULT_TYPE_BOTH = 'CheckResult_Type_Both';


    /**
     * 单向校验好友关系
     */
    public const CHECK_RESULT_TYPE_SINGLE = 'CheckResult_Type_Single';




    /*
    |--------------------------------------------------------------------------
    | 删除好友
    |--------------------------------------------------------------------------
    */

    /**
     * 单向删除好友
     */
    public const DELETE_TYPE_SINGLE = 'Delete_Type_Single';


    /**
     * 双向删除好友
     */
    public const DELETE_TYPE_BOTH = 'Delete_Type_Both';





    /*
    |--------------------------------------------------------------------------
    | 添加好友
    |--------------------------------------------------------------------------
    */

    /**
     * 单向加好友
     */
    public const ADD_TYPE_SINGLE = 'Add_Type_Single';


    /**
     * 双向加好友
     */
    public const ADD_TYPE_BOTH = 'Add_Type_Both';




    /*
    |--------------------------------------------------------------------------
    | 管理员强制加好友标记
    |--------------------------------------------------------------------------
    */

    /**
     * 强制加好友
     */
    public const FORCE_ADD_FRIEND = 1;


    /**
     * 常规加好友
     */
    public const NORMAL_ADD_FRIEND = 0;



    /*
    |--------------------------------------------------------------------------
    | 标配资料字段
    |--------------------------------------------------------------------------
    */

    /**
     * 昵称
     */
    public const TAG_PROFILE_IM_NICK = 'Tag_Profile_IM_Nick';

    /**
     * 性别
     */
    public const TAG_PROFILE_IM_GENDER = 'Tag_Profile_IM_Gender';

    /**
     * 生日
     */
    public const TAG_PROFILE_IM_BIRTHDAY = 'Tag_Profile_IM_BirthDay';

    /**
     * 所在地
     */
    public const TAG_PROFILE_IM_LOCATION = 'Tag_Profile_IM_Location';

    /**
     * 个性签名
     */
    public const TAG_PROFILE_IM_SELF_SIGNATURE = 'Tag_Profile_IM_SelfSignature';

    /**
     * 加好友验证方式
     */
    public const TAG_PROFILE_IM_ALLOW_TYPE = 'Tag_Profile_IM_AllowType';

    /**
     * 语言
     */
    public const TAG_PROFILE_IM_LANGUAGE = 'Tag_Profile_IM_Language';

    /**
     * 头像URL
     */
    public const TAG_PROFILE_IM_IMAGE = 'Tag_Profile_IM_Image';

    /**
     * 消息设置
     */
    public const TAG_PROFILE_IM_MSG_SETTINGS = 'Tag_Profile_IM_MsgSettings';

    /**
     * 	管理员禁止加好友标识
     */
    public const TAG_PROFILE_IM_ADMIN_FORBID_TYPE = 'Tag_Profile_IM_AdminForbidType';

    /**
     * 等级
     */
    public const TAG_PROFILE_IM_LEVEL = 'Tag_Profile_IM_Level';

    /**
     * 角色
     */
    public const TAG_PROFILE_IM_ROLE = 'Tag_Profile_IM_Role';

    /*
    |--------------------------------------------------------------------------
    | 性别
    |--------------------------------------------------------------------------
    */

    /**
     * 没设置性别
     */
    public const GENDER_TYPE_UNKNOWN = 'Gender_Type_Unknown';

    /**
     * 女性
     */
    public const GENDER_TYPE_FEMALE = 'Gender_Type_Female';

    /**
     * 男性
     */
    public const GENDER_TYPE_MALE = 'Gender_Type_Male';


    /*
    |--------------------------------------------------------------------------
    | 加好友验证方式
    |--------------------------------------------------------------------------
    */

    /**
     * 允许任何人添加自己为好友
     */
    public const ALLOW_TYPE_TYPE_ALLOW_ANY = 'AllowType_Type_AllowAny';

    /**
     * 不允许任何人添加自己为好友
     */
    public const ALLOW_TYPE_TYPE_DENY_ANY = 'AllowType_Type_DenyAny';

    /**
     * 需要经过自己确认才能添加自己为好友
     */
    public const ALLOW_TYPE_TYPE_NEED_CONFIRM = 'AllowType_Type_NeedConfirm';


    /*
    |--------------------------------------------------------------------------
    | 管理员禁止加好友标识
    |--------------------------------------------------------------------------
    */

    /**
     * 默认值，允许加好友
     */
    public const ADMIN_FORBID_TYPE_NONE = 'AdminForbid_Type_None';

    /**
     * 禁止该用户发起加好友请求
     */
    public const ADMIN_FORBID_TYPE_SEND_OUT = 'AdminForbid_Type_SendOut';


    /*
    |--------------------------------------------------------------------------
    | 标配好友字段
    |--------------------------------------------------------------------------
    */

    /**
     * 好友分组
     */
    public const TAG_SNS_IM_GROUP = 'Tag_SNS_IM_Group';

    /**
     * 好友备注
     */
    public const TAG_SNS_IM_REMARK = 'Tag_SNS_IM_Remark';

    /**
     * 加好友来源
     */
    public const TAG_SNS_IM_ADD_SOURCE = 'Tag_SNS_IM_AddSource';

    /**
     * 加好友附言
     */
    public const TAG_SNS_IM_ADD_WORDING = 'Tag_SNS_IM_AddWording';
}
