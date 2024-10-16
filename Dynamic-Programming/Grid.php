<?php
function gridTraveler(int $r, int $c, $map = []): int
{

    $key = $r + $c;

    if (isset($map[(string)$key])) {
        return $map[(string)$key];
    }

    if ($r === 1 && $c === 1) {
        return 1;
    }

    if ($r === 0 || $c === 0) {
        return 0;
    }

    $map[(string)$key] = gridTraveler($r - 1, $c) + gridTraveler($r, $c - 1);

    return $map[(string)$key];
}


echo "Ways on 10,10:" . gridTraveler(10, 10);
