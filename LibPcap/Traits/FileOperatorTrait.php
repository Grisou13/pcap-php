<?php
namespace LibPcap\Traits;

use LibPcap\File\Pcap;
use LibPcap\Packet\Packet;

/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 03.11.2015
 * Time: 14:10
 */
trait FileOperatorTrait
{
    protected $_file;

    public function __construct($file=null)
    {
        if(isset($file))
            $this->_file=new Pcap($file);

    }
    public function __destruct()
    {
        //just close the file
        $this->close();
    }
    public function open($filepath)
    {
      if(!file_exists($filepath))
        throw new Exception("The file $filepath is not valid");

      $this->_file=new Pcap($filepath);
      return $this;
    }
    
    public function close()
    {
        $this->_file->close();
    }

}
