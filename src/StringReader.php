<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午3:02
 */

namespace niceforbear\sparser;

/**
 * Scanner自身并不直接操作文件或字符串, 而是用Reader对象来代替自己执行操作.
 *
 * 这样可以轻松的切换数据源
 */
class StringReader extends Reader
{
    private $in;
    private $pos;

    public function __construct($in)
    {
        $this->in = $in;
        $this->pos = 0;
    }

    public function getChar()
    {
        if ($this->pos >= strlen($this->in)) {
            return false;
        }
        $char = substr($this->in, $this->pos, 1);
        $this->pos++;
        return $char;
    }

    public function getPos()
    {
        return $this->pos;
    }

    public function pushBackChar()
    {
        $this->pos--;
    }

    public function string()
    {
        return $this->in;
    }
}