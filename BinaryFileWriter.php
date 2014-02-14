<?php

/**
 * helper class to write binary files
 *
 * @category    PHP
 * @package     BinaryFileWriter
 * @author      Jan Fischer, bitWorking <info@bitworking.de>
 * @copyright   2014 Jan Fischer
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class BinaryFileWriter
{
    const ENDIAN_BIG_ENDIAN = 0;
    const ENDIAN_LITTLE_ENDIAN = 1;

    protected $_fileHandle;
    protected $_endian = self::ENDIAN_BIG_ENDIAN;

    public function __construct($fileName = null)
    {
        if (null !== $fileName) {
            $this->init($fileName);
        }
    }
    
    public function init($fileName)
    {
        $this->_fileHandle = @fopen($fileName, "wb");
        if (false === $this->_fileHandle) {
            throw new \Exception('Could not open file for writing');
        }
    }

    public function setEndian($endian)
    {
        $this->_endian = $endian;
    }

    public function writeByte($byte)
    {
        fwrite($this->_fileHandle, pack('c', $byte), 1);
    }

    public function writeString($string)
    {
        fwrite($this->_fileHandle, $string, strlen($string));
    }

    public function writeShort($short)
    {
        $format = ($this->_endian === self::ENDIAN_BIG_ENDIAN) ? 'n' : 'v';
        fwrite($this->_fileHandle, pack($format, $short), 2);
    }

    public function writeInt($int)
    {
        $format = ($this->_endian === self::ENDIAN_BIG_ENDIAN) ? 'N' : 'V';
        fwrite($this->_fileHandle, pack($format, $int), 4);
    }

    public function close()
    {
        fclose($this->_fileHandle);
        $this->_fileHandle = null;
    }

    public function __destruct()
    {
        if (null !== $this->_fileHandle) {
            $this->close();
        }
    }
}