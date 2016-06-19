<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午3:02
 */

namespace niceforbear\sparser;

/**
 * Context: 供解析器使用的信息交流点.
 */
class Context
{
    public $resultstack = [];

    public function pushResult($mixed)
    {
        array_push($this->resultstack, $mixed);
    }

    public function popResult()
    {
        return array_pop($this->resultstack);
    }

    public function resultCount()
    {
        return count($this->resultstack);
    }

    public function peekResult()
    {
        if (empty($this->resultstack)) {
            throw new \Exception('empty resultstack');
        }
        return $this->resultstack[count($this->resultstack) - 1];
    }
}