<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:39
 */

namespace niceforbear\sparser;


class StringLiteralParse extends Parser
{
    function trigger(Scanner $scanner)
    {
        return ($scanner->tokenType() == Scanner::APOS ||
                $scanner->tokenType() == Scanner::QUOTE);
    }

    protected function push(Scanner $scanner)
    {
        return;
    }

    protected function doScan(Scanner $scanner)
    {
        $quotechar = $scanner->tokenType();
        $ret = false;
        $string = "";
        while($token = $scanner->nextToken()){
            if($token == $quotechar){
                $ret = true;
                break;
            }
            $string .= $scanner->token();
        }

        if($string && !$this->discard){
            $scanner->getContext()->pushResult($string);
        }

        return $ret;
    }
}