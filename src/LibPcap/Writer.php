<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 03.11.2015
 * Time: 14:10
 */

namespace LibPcap;


use LibPcap\Packet\Packet;
use LibPcap\Traits\FileOperatorTrait;

class Writer
{
    use FileOperatorTrait;
    public function add(Packet $p)
    {
        $this->_file->addPacket($p);
        $this->_file->save();
        return $this;
    }
}