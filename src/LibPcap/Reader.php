<?php
namespace LibPcap;
use LibPcap\Traits\FileOperatorTrait;

/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 08:29
 */
class Reader
{
    use FileOperatorTrait;
    public function packets()
    {
        return $this->_file->getPackets();
    }
}
