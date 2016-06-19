# String Parser

## Install

Via Composer

``` bash
$ composer require niceforbear/StrParser
```

## Usage

``` php
$context = new Context();
$user_in = "\$input equals '4' or \$input equals 'four'";
$reader = new StringReader($user_in);
$scanner = new Scanner($reader, $context);

while ($scanner->nextToken() != Scanner::EOF) {
    print $scanner->token();
    print "\t{$scanner->char_no()}";
    print "\t{$scanner->getTypeString()}\n";
}
```

```
$input = 'five';
$statement = "( \$input equals 'five')";

$engine = new MarkParse($statement);
$result = $engine->evaluate($input);
print "input: $input evaluating: $statement\n";
if($result){
    print "true!\n";
}else{
    print "false!\n";
}
```

## Testing

Tests unavailable.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [niceforbear](https://github.com/niceforbear)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## About EBNF

- expr ::= operand (orExpr | andExpr) *
- operand ::= ( '(' expr ')' | <stringLiteral> | variable ) (eqExpr) *
- orExpr ::= 'or' operand
- andExpr ::= 'and' operand
- eqExpr ::= 'equals' operand
- variable ::= '$' <word>