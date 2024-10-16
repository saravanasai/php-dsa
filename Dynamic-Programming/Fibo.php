<?php


function fibo($n, $map = []): int
{
    if (isset($map["$n"])) {
        return $map["$n"];
    }
    if ($n <= 2) {
        return 1;
    }

    $map["$n"] = fibo($n - 1) + fibo($n - 2);
    return $map["$n"];
}

echo fibo(30);
