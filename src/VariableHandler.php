<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午5:31
 */

namespace niceforbear\sparser;


class VariableHandler implements Handler
{
    function handleMatch(Parser $parser, Scanner $scanner)
    {
        $varname = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult(new VariableHandler($varname));
    }
}