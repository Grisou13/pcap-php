<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 02.11.2015
 * Time: 11:54
 */

namespace LibPcap\File;


use LibPcap\Buffer;

class Magic
{
    protected $magic;
    public function __construct(Buffer $buffer)
    {
        $row = unpack("Vmagic", $buffer->get(4));
        $this->magic = sprintf("%x",$row["magic"]);
    }
    public function getMagic()
    {
        return $this->magic;
    }
    public function __toString()
    {
        return $this->getMagic();
    }
}