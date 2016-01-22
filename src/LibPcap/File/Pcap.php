<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 08:38
 */

namespace LibPcap\File;


use LibPcap\Buffer;
use LibPcap\Packet\Packet;
use LibPcap\Packet\PacketBuffer;

class Pcap
{
    protected $_handle;//file handle

    protected $packets;//list of packets


    public function __construct($filepath)
    {
        $this->_handle=$this->open($filepath);

        $this->packets = new PacketBuffer(new Buffer($this->_handle),$this->getHeader(),$this->getEncoding());

    }

    public function open($filepath,$mode="r")
    {
        $r = fopen($filepath,$mode);

        return $r;
    }
    public function close()
    {
        fclose($this->_handle);
    }
    public function save($packets=array(),$close=false)
    {
        $line="";
        $p = array_merge($this->packets,$packets);
        foreach($p as $packet)
        {
            $line.=$packet->encode();
        }

        fputs($this->_handle,$line);
        if($close){$this->close();}
    }

    protected function getMagic()
    {
        if(isset($this->magic))
            return $this->magic;
        else
            $this->magic = new Magic(new Buffer($this->_handle));
        return $this->magic;
    }
    protected function getEncoding()
    {
        return new Encoding($this->getMagic());
    }
    protected function getHeader()
    {

        return new GlobalHeader(new Buffer($this->_handle),$this->getEncoding());

    }
    public function getPacket($index)
    {
        return $this->packets->get($index);
    }
    public function getPackets()
    {
        return $this->packets->get();
    }
    public function addPacket(Packet $packet)
    {
        $this->packets->add($packet);
    }
    public function removePacket(Packet $packet)
    {
        $this->packets->remove($packet);
    }

}