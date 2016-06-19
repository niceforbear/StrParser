<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:23
 */

namespace niceforbear\sparser;


class CharacterParse extends Parser
{
    private $char;
    function __construct($char, $name = null, $options = null)
    {
        parent::__construct($name, $options);
        $this->char = $char;
    }

    function trigger(Scanner $scanner)
    {
        return ($scanner->token() == $this->char);
    }

    protected function doScan(Scanner $scanner)
    {
        return ($this->trigger($scanner));
    }
}