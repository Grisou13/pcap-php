<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 29.10.2015
 * Time: 14:38
 */

namespace LibPcap\Packet\Protocols;


class NoProtocol
{
    protected $protocolName = "none";
    public function encode()
    {

    }
    public function decode()
    {

    }
    public function __get($k)
    {
      return null;
    }
    public function __call($funcName,$args)
    {
      return null;
    }
}
