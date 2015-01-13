<?php


namespace MT\DoctrineExtension;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;


class DateFormatFunction extends FunctionNode
{   
    public $DateExpression = null;
    public $format=null;
    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return'DATE_FORMAT(' . $this->DateExpression->dispatch($sqlWalker) . ',' . $this->format->dispatch($sqlWalker). ')';
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->DateExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->format = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
