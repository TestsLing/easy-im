<?php


namespace EasyIM\TencentIM\Sns\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class SnsItemAttr
 *
 * @package EasyIM\TencentIM\Sns\Attribute
 * @author  longing <hacksmile@126.com>
 */
class SnsItemAttr extends CustomItemAttr
{
    protected $required = ['Tag', 'Value'];

}
