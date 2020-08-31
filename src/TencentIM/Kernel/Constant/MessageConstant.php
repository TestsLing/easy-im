<?php


namespace EasyIM\TencentIM\Kernel\Constant;


class MessageConstant
{

    /*
    |--------------------------------------------------------------------------
    | Message Type
    |--------------------------------------------------------------------------
    */

    /**
     * @var string 自定义消息
     */
    const TIM_CUSTOM_ELEM = 'TIMCustomElem';

    /**
     * @var string 表情消息
     */
    const TIM_FACE_ELEM = 'TIMFaceElem';

    /**
     * @var string 地理位置消息
     */
    const TIM_LOCATION_ELEM = 'TIMLocationElem';

    /**
     * @var string 文本消息
     */
    const TIM_TEXT_ELEM = 'TIMTextElem';
}