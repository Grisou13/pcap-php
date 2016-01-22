<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 02.11.2015
 * Time: 10:10
 */

namespace LibPcap\Packet;


use LibPcap\Buffer;
use LibPcap\File\Encoding;
use LibPcap\File\GlobalHeader;

class PacketBuffer implements \Iterator
{
    protected $index;//iterator count
    protected $packets;
    protected $buffer;


    public function __construct(Buffer $raw,GlobalHeader $header,Encoding $encoding)
    {
        $this->buffer = $raw;
        $this->header=$header;
        $this->encoding=$encoding;
        $this->decode();
        $this->index=1;
    }
    public function limit($length)
    {
        if(count($this->packets)<$length)
        {
            return $this->packets = array_slice($this->packets,0,$length);
        }
    }
    public function filter($filter)
    {

    }
    protected function decode()
    {
        $buffer = $this->buffer;
        $enc = $this->encoding;

        while(!$buffer->finished())
        {
            //$this->buffer->startIndex(1);
            $p = new Packet($buffer,$enc);
            if($p->isCorrect())
            {
              if($a = $p->decode())
                  $this->add($a);
            }

        }
        return $this->packets;
    }
    public function get($index=null)
    {
        if(isset($index))
            return $this->packets[$index];
        return $this->packets;
    }
    public function add(Packet $packet)
    {
        $this->packets[++$this->index]=$packet;
    }
    public function remove(Packet $packet)
    {

    }
    /*Inherited from iterator*/
    public function valid()
    {
        return isset($this->packets[$this->index]);
    }
    public function current()
    {
        return $this->packets[$this->index];
    }
    public function key()
    {
        return $this->index;
    }
    public function rewind()
    {
        $this->index=1;
    }
    public function next()
    {
        ++$this->index;
    }
}
