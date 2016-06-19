<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午5:37
 */

$input = 'five';
$statement = "( \$input equals 'five')";

$engine = new \niceforbear\StrParser\MarkParse($statement);
$result = $engine->evaluate($input);
print "input: $input evaluating: $statement\n";
if($result){
    print "true!\n";
}else{
    print "false!\n";
}