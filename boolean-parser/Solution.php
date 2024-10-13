<?php

class Solution
{
    public SplStack $stack;

    public function __construct()
    {
        $this->stack = new SplStack();
    }

    public function evalWithOp(array $values, string $op): bool
    {
        $opStack = new SplStack();
        foreach ($values as $value) {
            $opStack->push($value);
        }

        if ($opStack->count() == 1) {
            return $opStack->pop() == "t";
        }

        while (!$opStack->isEmpty()) {

            if ($opStack->count() == 1) {
                return $opStack->pop() == "t";
            }

            $opOne = $opStack->pop();
            $opTwo = $opStack->pop();
            $leftOp = $opOne == "t";
            $rightOp = $opTwo == "t";

            if ($op == "&") {
                $opStack->push(($leftOp && $rightOp) ? "t" : "f");
            }

            if ($op == "|") {
                $opStack->push(($leftOp || $rightOp) ? "t" : "f");
            }
        }
    }

    public function parseInnerExp(string $exp, string $op)
    {
        $values = explode(",", $exp);
        return $this->evalWithOp($values, $op);
    }

    public function evalExp(string $innerExp): bool
    {
        if ($innerExp[0] == "&") {
            return $this->parseInnerExp(substr($innerExp, 2, -1), "&");
        }

        if ($innerExp[0] == "|") {
            return $this->parseInnerExp(substr($innerExp, 2, -1), "|");
        }

        if ($innerExp[0] == "!") {
            return !$this->parseInnerExp(substr($innerExp, 2, -1), "!");
        }
        return true;
    }


    public function getExpression(): string
    {
        $innerExp = "";
        while ($this->stack->top() != "(") {
            $innerExp = $this->stack->pop() . $innerExp;
        }
        $innerExp = $this->stack->pop() . $innerExp;
        return  $this->stack->pop() . $innerExp;
    }
    /**
     * @param String $exp
     * @return Boolean
     */
    public function parseBoolExpr(string $exp): bool
    {
        $expLen = strlen($exp);
        for ($i = 0; $i < $expLen; $i++) {
            if ($exp[$i] == ")") {
                $this->stack->push($exp[$i]);
                $innerExp = $this->getExpression();
                $expValue = $this->evalExp($innerExp);
                $this->stack->push($expValue ? "t" : "f");
            } else {
                $this->stack->push($exp[$i]);
            }
        }
        return $this->stack->top() == "t" ? true : false;
    }
}

//output : true
// $input = "|(&(t,f,t),t)";
$input = "|(&(t,f,t),t)";
$sol = new Solution();

$result = $sol->parseBoolExpr($input);

echo "Result:" . (bool) $result;
