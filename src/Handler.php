<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午5:31
 */

namespace niceforbear\sparser;


interface Handler
{
    function handleMatch(Parser $parser, Scanner $scanner);
}