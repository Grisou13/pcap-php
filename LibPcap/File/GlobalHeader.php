<?php
/**
 * Created by PhpStorm.
 * User: tricci
 * Date: 28.10.2015
 * Time: 10:36
 */

namespace LibPcap\File;


use LibPcap\Buffer;

class GlobalHeader implements \ArrayAccess
{
    protected $_data;
    public function __construct(Buffer $buffer,Encoding $encoding)
    {
        $this->buffer=$buffer;
        $this->encoding=$encoding;
        $this->_data =unpack($encoding->u16."version_major/".
            $encoding->u16."version_minor/".
            $encoding->u32."thiszone/".
            $encoding->u32."sigfigs/".
            $encoding->u32."snaplen/".
            $encoding->u32."network",
        $this->buffer->get(20));
    }
    public function __get($k)
    {
        return $this->_data[$k];
    }
    public function __set($k,$v)
    {
        $this->_data[$k]=$v;
    }
    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->_data[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->_data[$offset]=$value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }
}