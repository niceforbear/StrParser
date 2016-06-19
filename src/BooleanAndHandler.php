<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午5:35
 */

namespace niceforbear\StrParser;


class BooleanAndHandler implements Handler
{
    function handleMatch(Parser $parser, Scanner $scanner)
    {
        $comp1 = $scanner->getContext()->popResult();
        $comp2 = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult(
            new BooleanAndExpression($comp1, $comp2)
        );
    }
}