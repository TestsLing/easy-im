<?php


namespace EasyIM\TencentIM\Sns\Parameter;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class SnsItemParameter
 *
 * @package EasyIM\TencentIM\Sns\Attribute
 * @author  longing <hacksmile@126.com>
 */
class SnsItemParameter extends CustomItemParameter
{
    protected $required = ['Tag', 'Value'];

}
