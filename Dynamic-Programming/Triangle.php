<?php

class Solution
{
    // bottom-up approach 
    function minimumTotal($triangle): int
    {
        $rowTotal = count($triangle);
        // array filled for last row
        $dp = array_fill(0, $rowTotal, 0);
        for ($i = $rowTotal - 1; $i >= 0; $i--) {
            for ($j = 0; $j < count($triangle[$i]); $j++) {
                $dp[$j] = $triangle[$i][$j] + min($dp[$j], $dp[$j + 1]);
            }
        }
        return $dp[0];
    }
}


$sol = new Solution();

echo $sol->minimumTotal([[2], [3, 4], [6, 5, 7], [4, 1, 8, 3]]);
echo $sol->minimumTotal([[-10]]);
echo $sol->minimumTotal([[-1], [2, 3], [1, -1, -3]]);
