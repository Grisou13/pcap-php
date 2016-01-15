<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 10:38
 */

namespace LibPcap\File;


class Encoding
{
    public function __construct(Magic $magic)
    {

        $enc = $this->getEncoding($magic);
        $this->u16 = $enc["u16"];
        $this->u32 = $enc["u32"];
    }
    public function getEncoding($magic)
    {
        switch ($magic) {
            case "a1b2c3d4":
                $u32 = "V";
                $u16 = "v";
                break;
            case "d4c3b2a1":
                $u32 = "N";
                $u16 = "n";
                break;
            default:
                throw new \Exception("Unknown encoding: '" . $magic . "'");
                break;
        }
        return compact("u16", "u32");
    }
}