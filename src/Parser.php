<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午3:07
 */

namespace niceforbear\StrParser;

/**
 * Parser首先调用抽象的doScan方法, 把工作委托给具体的子类.
 * 如果doScan成功,解析结果将被压入context对象的结果栈中.
 * Scanner对象中保存的Context被Parser对象用于访问结果.
 *
 *
 *
 */
abstract class Parser
{
    const GIP_RESPECTSPACE = 1;
    protected $respectSpace = false;
    protected static $debug = false;
    protected $discard = false;
    protected $name;
    private static $count = 0;

    function __construct($name = null, $options = null)
    {
        if(is_null($name)){
            self::$count++;
            $this->name = get_class($this) . " (".self::$count.")";
        }else{
            $this->name = $name;
        }
        if(is_array($options)){
            if(isset($options[self::GIP_RESPECTSPACE])){
                $this->respectSpace = true;
            }
        }
    }

    protected function next(Scanner $scanner){
        $scanner->nextToken();
        if(!$this->respectSpace){
            $scanner->eatWhiteSpace();
        }
    }

    function spaceSignificant($bool){
        $this->respectSpace = $bool;
    }

    static function setDebug($bool){
        self::$debug = $bool;
    }

    function setHandler(Handler $handler){
        $this->handler = $handler;
    }

    final function scan(Scanner $scanner){
        if($scanner->tokenType() == Scanner::SOF){
            $scanner->nextToken();
        }
        $ret = $this->doScan($scanner);
        if($ret && !$this->discard && $this->term()){
            $this->push($scanner);
        }
        if($ret){
            $this->invokeHandler($scanner);
        }
        if($this->term() && $ret){
            $this->next($scanner);
        }
        $this->report("::scan returning $ret");
        return $ret;
    }

    function discard(){
        $this->discard = true;
    }

    abstract function trigger(Scanner $scanner);

    function term(){
        return true;
    }

    protected function invokeHandler(Scanner $scanner){
        if(!empty($this->handler)){
            $this->report("calling handler: " . get_class($this->handler));
            $this->handler->handleMatch($this, $scanner);
        }
    }

    protected function report($msg){
        if(self::$debug){
            print "<{$this->name}>".get_class($this)."$msg\n";
        }
    }

    protected function push(Scanner $scanner){
        $context = $scanner->getContext();
        $context->pushResult($scanner->token());
    }

    abstract protected function doScan(Scanner $scanner);
}