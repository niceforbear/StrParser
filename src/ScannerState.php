<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午3:02
 */

namespace niceforbear\sparser;

class ScannerState
{
    public $line_no;
    public $char_no;
    public $token;
    public $token_type;
    public $r;
    public $context;
}
