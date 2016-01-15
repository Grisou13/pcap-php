<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 03.11.2015
 * Time: 10:22
 */

namespace LibPcap\Packet\Protocols;


use LibPcap\Buffer;
use LibPcap\File\Encoding;

abstract class Protocol
{
    protected $isMalphormed = true;
    protected $_attributes;
    protected $protocolName;
    protected $headData;
    protected $valid = false;
    public function __construct(array $headData,Encoding $encoding)
    {
      $this->_attributes=array();
        $this->setHeadData($headData);
        $this->setEncoding($encoding);
        $this->fill($headData);
    }
    public function __get($k)
    {
        return (isset($this->{$k}))?$this->{$k}:$this->_attributes[$k];
    }
    public function getValid()
    {
      return $this->valid;
    }
    public function isValid()
    {
      return $this->getValid();
    }
    public function setValid($state)
    {
      $this->valid=$state;
    }
    public function getEncoding()
    {
      return $this->encoding;
    }
    public function setEncoding(Encoding $enconding)
    {
      $this->enconding = $enconding;
      return $this;
    }
    public function isCorrect()
    {
        return !$this->isMalphormed;
    }
    public function getName()
    {
        return $this->protocolName;
    }
    public function getSourcePort()
    {
        return $this->src_port;
    }
    public function getDestinationPort()
    {
        return $this->dst_port;
    }
    public function fill($data)
    {
      //just a passthrough
      //TODO: maybe validate some data that comes in here
      return $this->fillDirty($data);
    }
    protected function fillDirty($data)
    {
        $this->_attributes=array_merge($this->_attributes,$data);
    }
    public function getAttributes()
    {
      return $this->_attributes;
    }
    public function getRawData()
    {
      if(array_key_exists("data",$this->headData))
        return $this->headData["data"];
      return null;
    }
    public function setRawData($data)
    {
      $this->headData["data"]=$data;
      return $this;
    }
    public function getHeadData()
    {
      return $this->headData;
    }
    public function setHeadData(array $data)
    {
      $this->headData=$data;
      return $this;
    }
    abstract function decode();
    abstract function encode();
}
