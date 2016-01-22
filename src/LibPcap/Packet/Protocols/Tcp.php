<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 10:46
 */

namespace LibPcap\Packet\Protocols;


class Tcp extends Protocol
{
    protected $protocolName = "tcp";
    public function encode()
    {

    }
    public function decode()
    {
        $d = $this->getHeadData();

        if( !isset($d["protocol"]) )
          return false;



        $x = @unpack(
        "nsource_port".
        "/ndestination_port".
        "/Nseq".
        "/Nack".
        "/Ctmp1".
        "/Ctmp2".
        "/nwindow".
        "/nchecksum".
        "/nurgent"
        , $this->getRawData());
        if( !isset($x["tmp1"]) )//if we don't have this in our array of data, we can consider that we cannot decode this packet as TCP
            return false;

        $x['offset'] = ($x['tmp1']>>4)&0xf;
        $x['flag_NS'] = ($x['tmp1']&0x01) != 0;
        $x['flag_CWR'] = ($x['tmp2']&0x80) != 0;
        $x['flag_ECE'] = ($x['tmp2']&0x40) != 0;
        $x['flag_URG'] = ($x['tmp2']&0x20) != 0;
        $x['flag_ACK'] = ($x['tmp2']&0x10) != 0;
        $x['flag_PSH'] = ($x['tmp2']&0x08) != 0;
        $x['flag_RST'] = ($x['tmp2']&0x04) != 0;
        $x['flag_SYN'] = ($x['tmp2']&0x02) != 0;
        $x['flag_FIN'] = ($x['tmp2']&0x01) != 0;
        unset($x['tmp1']);
        unset($x['tmp2']);
        $x['data'] = substr($d["data"], 4*$x['offset']);
        $this->fill($x);
        $this->setRawData($x["data"]);//resets the raw data
        return true;
    }
}
