<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:27
 */

namespace niceforbear\sparser;


abstract class CollectionParse extends Parser
{
    protected $parsers = [];

    function add(Parser $p){
        if(is_null($p)){
            throw new \Exception('Argument is null');
        }

        $this->parsers[] = $p;
        return $p;
    }

    function term()
    {
        return false;
    }
}