<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 02.11.2015
 * Time: 09:22
 */

namespace LibPcap;


class Buffer //implements \Iterator
{
    protected $iteratorIndex;
    protected $isIndexing;
    /**
     * Contains the buffer needed
     * @var resource
     */
    protected $handle;
    protected $length;
    protected $start;
    protected $data;


    protected $previousStep;
    protected $nextStep;
    protected $currentStep;
    public function __construct($handle,$len=16)
    {
        //if we can get the resource data
        if(is_resource($handle))
        {
          $meta = stream_get_meta_data($handle);
          if(!strstr($meta["mode"],"r"))
            throw new \Exception("The handle you passed to the buffer is not readable");
          $this->handle=$handle;
        }
        else
        {
            $this->handle=self::makeFromRawData($handle);
        }
        $this->length=$len;
        $this->start=ftell($this->handle);
    }
    public function getBuffer()
    {
        return $this->handle;
    }
    public function setBuffer($handle)
    {
        $this->handle=$handle;
    }
    public function getLength()
    {
        return $this->length;
    }
    public function setLength($len)
    {
        $this->length=$len;
    }
    public function get($length=null,$resetPosition=false)
    {
        $curPos=ftell($this->handle);
        $len=(!isset($length)&&empty($length))?$this->getLength():$length;
        if(!feof($this->handle))
        {

            $ret= fread($this->handle,$len);
            if($resetPosition){
                fseek($this->handle,$curPos);
                $this->current=$curPos;
            }
            else
            {
                $this->current=ftell($this->handle);
            }

            $this->data=$ret;
            return $ret;
        }
        return false;
    }
    public function getAll()
    {
      return stream_get_contents($this->handle);
    }
    public function finished()
    {
        return feof($this->handle);
    }
    public function getPrevious()
    {
        return $this->data;
    }
    public function getNext()
    {
        $this->get($this->length,true);
    }
    public function getCurrent()
    {

    }
    public function startIndex($index=1)
    {
        $this->iteratorIndex = $index;
    }
    public function getIndex()
    {
        return $this->iteratorIndex;
    }
    public function stopIndexing()
    {
        $this->isIndexing=false;
    }
    public function isIndexing()
    {
        return $this->isIndexing;
    }
    public static function makeFromRawData($data)
    {
      $h = fopen("php://temp","rw");
      fputs($h,$data);
      return $h;
    }
    /*Iterator*/
    /*public function rewind()
    {
        fseek($this->payload,$this->start);
    }
    public function next()
    {

    }
    public function current()
    {
        return $this->get();
    }
    public function key()
    {
        return $this->current;
    }
    public function valid()
    {
        return feof($this->payload);
    }
    public function __toString()
    {
        return fread($this->payload,$this->length);
    }*/
}
