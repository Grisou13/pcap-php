<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 29.10.2015
 * Time: 14:38
 */

namespace LibPcap\Packet\Protocols;


class Udp extends Protocol
{
    protected $protocolName = "udp";
    public function encode()
    {

    }
    public function decode()
    {
        $d = $this->getHeadData();
        if(!$d["protocol"]!==17)
            return false;

        $x = @unpack("nsource_port/ndestination_port/nlength/nchecksum",$d["data"]);
        $x['data'] = substr($d["data"],8,$x['length']-8);
        $this->setRawData($x["data"]);
        $this->fill($x);
        return true;
    }
}
