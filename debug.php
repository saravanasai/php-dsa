<?php

$result = [];
$n =2;
function backtrack($s = '', $left = 0, $right = 0,&$result) {
// Base case: if the current combination has length equal to 2n, it is a valid
    // combination and should be added to the result list.
    global $n;
    if (strlen($s) === 2 * $n) {
        $result[] = $s;
        return;
    }

    // If there are still left parentheses remaining, add a left parenthesis to the
    // current combination and recursively call backtrack with the updated parameters.
    if ($left < $n) {
        backtrack($s . '(', $left + 1, $right,$result);
    }

    // If there are still more right parentheses than left parentheses, add a right
    // parenthesis to the current combination and recursively call backtrack with the
    // updated parameters.
    if ($right < $left) {
        backtrack($s . ')', $left, $right + 1,$result);
    }
}



backtrack("",0,0,$result);
var_export($result);