<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:42
 */

namespace niceforbear\StrParser;


class WordParse extends Parser
{
    function __construct($word = null, $name = null, $options = null)
    {
        parent::__construct($name, $options);
        $this->word = $word;
    }

    function trigger(Scanner $scanner)
    {
        if($scanner->tokenType() != Scanner::WORD){
            return false;
        }

        if(is_null($this->word)){
            return true;
        }

        return ($this->word == $scanner->token());
    }

    protected function doScan(Scanner $scanner)
    {
        $ret = ($this->trigger($scanner));
        return $ret;
    }
}