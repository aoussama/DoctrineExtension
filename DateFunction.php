<?php

namespace MT\DoctrineExtension;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class DateFunction extends FunctionNode
{   
    public $DateExpression = null;
    public $format=null;
    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return'DATE(' . $this->DateExpression->dispatch($sqlWalker) . ')';
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->DateExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
