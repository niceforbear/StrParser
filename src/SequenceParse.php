<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:28
 */

namespace niceforbear\StrParser;


class SequenceParse extends CollectionParse
{
    function trigger(Scanner $scanner)
    {
        if(empty($this->parsers)){
            return false;
        }

        return $this->parsers[0]->trigger($scanner);
    }

    protected function doScan(Scanner $scanner)
    {
        $start_state = $scanner->getState();
        foreach($this->parsers as $parser){
            if(!($parser->trigger($scanner) && $scan = $parser->scan($scanner))){
                $scanner->setState($start_state);
                return false;
            }
        }
        return true;
    }
}