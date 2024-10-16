<?php


function fibo($n, $map = []): int
{
    if (isset($map[(string)$n])) {
        return $map[(string)$n];
    }
    if ($n <= 2) {
        return 1;
    }

    $map[(string)$n] = fibo($n - 1) + fibo($n - 2);
    return $map[(string)$n];
}

echo fibo(30);
