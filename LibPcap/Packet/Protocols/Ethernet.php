<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 29.10.2015
 * Time: 14:38
 */

namespace LibPcap\Packet\Protocols;


class Ethernet extends Protocol
{
    protected $protocolName = "udp";
    public function encode()
    {

    }
    public function decode()
    {
      $data = $this->getRawData();
      $x = @unpack("nethertype", substr($data,12,2));
      $x['destination_mac'] = bin2hex(substr($data,0,6));
      $x['source_mac'] = bin2hex(substr($data,6,6));
      $x['data'] = substr($data,14);
      $this->fill($x);
      $this->setRawData($x["data"]);
      $this->setValid(true);
      return true;
    }
}
