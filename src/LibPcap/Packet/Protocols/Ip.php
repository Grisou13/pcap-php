<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 29.10.2015
 * Time: 14:38
 */

namespace LibPcap\Packet\Protocols;


class Ip extends Protocol
{
    protected $protocolName = "ip";
    public function encode()
    {

    }
    public function decode()
    {
      $data = $this->getRawData();

      $x = @unpack("Cversion_ihl/Cservices/nlength/nidentification/nflags_offset/Cttl/Cprotocol/nchecksum/Nsource/Ndestination", $data);
      if( !isset($x["version_ihl"]) )
        return false;

      $x['version'] = $x['version_ihl'] >> 4;
      $x['ihl'] = $x['version_ihl'] & 0xf;
      unset($x['version_ihl']);
      $x['flags'] = $x['flags_offset'] >> 13;
      $x['offset'] = $x['flags_offset'] & 0x1fff;
      $x['source_ip'] = long2ip($x['source']);
      $x['destination_ip'] = long2ip($x['destination']);
      $x['data'] = substr($data,$x['ihl']*4,$x['length']-$x['ihl']*4); // ignoring options
      $this->fill($x);
      $this->setRawData($x["data"]);
      return true;
    }
}
