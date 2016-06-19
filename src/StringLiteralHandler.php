<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午5:32
 */

namespace niceforbear\sparser;


class StringLiteralHandler implements Handler
{
    function handleMatch(Parser $parser, Scanner $scanner)
    {
        $value = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult(new LiteralExpression($value));
    }
}