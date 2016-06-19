<?php
/**
 * @author nesfoubaer
 * @date 16/6/19 下午4:46
 */

namespace niceforbear\sparser;


class MarkParse
{
    private $expression;
    private $operand;
    private $interpreter;
    private $context;

    function __construct($statement)
    {
        $this->compile($statement);
    }

    function evaluate($input){
        $icontext = new InterpreterContext();
        $prefab = new VariableExpression('input', $input);
        $prefab->interpret($icontext);

        $this->interpreter->interpret($icontext);
        $result = $icontext->lookup($this->interpreter);
        return $result;
    }

    function compile($statement_str){
        $context = new Context();
        $scanner = new Scanner(new StringReader($statement_str), $context);
        $statement = $this->expression();
        $scanresult = $statement->scan($scanner);

        if(!$scanresult || $scanner->tokenType() != Scanner::EOF){
            $msg = "";
            $msg .= " line: {$scanner->line_no()} ";
            $msg .= " char: {$scanner->char_no()} ";
            $msg .= " token: {$scanner->token()}\n";
            throw new \Exception($msg);
        }

        $this->interpreter = $scanner->getContext()->popResult();
    }

    function expression(){
        if(!isset($this->expression)){
            $this->expression = new SequenceParse();
            $this->expression->add($this->operand());
            $bools = new RepetitionParse();
            $whichbool = new AlternationParse();
            $whichbool->add($this->orExpr());
            $whichbool->add($this->andExpr());
            $bools->add($whichbool);
            $this->expression->add($bools);
        }

        return $this->expression;
    }

    function orExpr(){
        $or = new SequenceParse();
        $or->add(new WordParse('or'))->discard();
        $or->add($this->operand());
        $or->setHandler(new BooleanOrHandler());
        return $or;
    }

    function andExpr(){
        $and = new SequenceParse();
        $and->add(new WordParse('and'))->discard();
        $and->add($this->operand());
        $and->setHandler(new BooleanAndHandler());
        return $and;
    }

    function operand(){
        if(!isset($this->operand)){
            $this->operand = new SequenceParse();
            $comp = new AlternationParse();
            $exp = new SequenceParse();
            $exp->add(new CharacterParse('('))->discard();
            $exp->add($this->expression());
            $exp->add(new CharacterParse(')'))->discard();
            $comp->add($exp);
            $comp->add(new StringLiteralParse())->setHandler(new StringLiteralHandler());
            $comp->add($this->variable());
            $this->operand->add($comp);
            $this->operand->add(new RepetitionParse())->add($this->eqExpr());
        }
        return $this->operand();
    }

    function eqExpr(){
        $equals = new SequenceParse();
        $equals->add(new WordParse('equals'))->discard();
        $equals->add($this->operand());
        $equals->setHandler(new EqualsHandler());
        return $equals;
    }

    function variable(){
        $variable = new SequenceParse();
        $variable->add(new CharacterParse('$'))->discard();
        $variable->add(new WordParse());
        $variable->setHandler(new VariableHandler());
        return $variable;
    }
}