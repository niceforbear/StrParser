<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:36
 */

namespace niceforbear\StrParser;


class AlternationParse extends CollectionParse
{
    function trigger(Scanner $scanner)
    {
        foreach($this->parsers as $parser){
            if($parser->trigger($scanner)){
                return true;
            }
        }
        return false;
    }

    protected function doScan(Scanner $scanner)
    {
        $type = $scanner->tokenType();
        $start_state = null;
        foreach($this->parsers as $parser){
            $start_state = $scanner->getState();
            if($type == $parser->trigger($scanner) && $parser->scan($scanner)){
                return true;
            }
        }
        $scanner->setState($start_state);
        return false;
    }
}