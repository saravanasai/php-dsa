<?php

class Solution
{
    private $scope;

    public function __construct()
    {
        $this->scope = [[]];
    }

    public function evaluate($expression)
    {
        array_push($this->scope, []);
        $result = $this->evaluateInner($expression);
        array_pop($this->scope);
        return $result;
    }

    private function evaluateInner($expression)
    {
        if ($expression[0] !== '(') {
            if (is_numeric($expression)) {
                return (int)$expression;
            }
            for ($i = count($this->scope) - 1; $i >= 0; $i--) {
                if (isset($this->scope[$i][$expression])) {
                    return $this->scope[$i][$expression];
                }
            }
        }

        $tokens = $this->parse(substr($expression, $expression[1] === 'm' ? 6 : 5, -1));
        if (strpos($expression, "add", 1) === 1) {
            return $this->evaluate($tokens[0]) + $this->evaluate($tokens[1]);
        } elseif (strpos($expression, "mult", 1) === 1) {
            return $this->evaluate($tokens[0]) * $this->evaluate($tokens[1]);
        } else {
            for ($j = 1; $j < count($tokens); $j += 2) {
                $this->scope[count($this->scope) - 1][$tokens[$j - 1]] = $this->evaluate($tokens[$j]);
            }
            return $this->evaluate($tokens[count($tokens) - 1]);
        }
    }

    private function parse($expression)
    {
        $result = [];
        $balance = 0;
        $buffer = "";

        foreach (explode(" ", $expression) as $token) {
            foreach (str_split($token) as $char) {
                if ($char === '(') $balance++;
                if ($char === ')') $balance--;
            }

            if (!empty($buffer)) $buffer .= " ";
            $buffer .= $token;

            if ($balance === 0) {
                $result[] = $buffer;
                $buffer = "";
            }
        }

        if (!empty($buffer)) {
            $result[] = $buffer;
        }

        return $result;
    }
}

$sol = new Solution();

// echo $sol->evaluate("(add 1 2)")."\n";
// echo $sol->evaluate("(mult 3 (add 2 3))")."\n";
// echo $sol->evaluate("(let x 2 (mult x 5))")."\n";

echo $sol->evaluate("(let x 2 (mult x (let x 3 y 4 (add x y))))") . "\n";
// echo $sol->evaluate("(let x 3 x 2 x)") . "\n";
// echo $sol->evaluate("(let x 1 y 2 x (add x y) (add x y))") . "\n";
// echo $sol->evaluate("(let x 2 (add (let x 3 (let x 4 x)) x))") . "\n";