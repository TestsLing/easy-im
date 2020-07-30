<?php


namespace EasyIM\TencentIM;

use Tencent\TLSSigAPIv2;


class Encryptor
{

    private $sdkAppId;
    private $secret;
    private $identifier;
    private $tLSSigAPIv2;

    public function __construct($sdkAppId, $secret, $identifier)
    {
        $this->sdkAppId = $sdkAppId;
        $this->secret = $secret;
        $this->identifier = $identifier;
        $this->tLSSigAPIv2 = new TLSSigAPIv2($sdkAppId, $secret);
    }

    /**
     *
     * @return string
     * @throws \Exception
     */
    public function signature() :string
    {
        return $this->tLSSigAPIv2->genSig($this->identifier);
    }
}
