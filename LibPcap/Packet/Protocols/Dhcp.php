<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 29.10.2015
 * Time: 14:38
 */

namespace LibPcap\Packet\Protocols;


use LibPcap\Buffer;

class Dhcp extends Protocol
{
    protected $protocolName = "dhcp";
    public function decode()
    {
      $d = $this->getHeadData();
      return $this;
    }
    public function encode()
    {

    }
}
