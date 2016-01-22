<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 29.10.2015
 * Time: 14:38
 */

namespace LibPcap\Packet\Protocols;


class Http extends Protocol
{
    protected $protocolName = "http";

    public function encode()
    {
      return false;
    }
    public function decode()
    {
      return null;
    }
}
