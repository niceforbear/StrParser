<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午3:02
 */

namespace niceforbear\sparser;


abstract class Reader
{
    abstract public function getChar();
    abstract public function getPos();
    abstract public function pushBackChar();
}