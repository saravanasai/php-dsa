<?php
class MinPathSum
{

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function minPathSum($grid)
    {
        $row = count($grid);
        $col = count($grid[0]);

        $dp = array_fill(0, $row, array_fill(0, $col, INF));
        $dp[$row][$col - 1] = 0;

        for ($i = $row - 1; $i >= 0; $i--) {
            $i;
            for ($j = $col - 1; $j >= 0; $j--) {
                $j;
                $right = $dp[$i][$j + 1] ?? PHP_INT_MAX;
                $down =  $dp[$i + 1][$j] ?? PHP_INT_MAX;
                $min = min($right, $down);
                $celVal =  $grid[$i][$j];
                $dp[$i][$j] = $celVal + $min;
            }
        }

        return $dp[0][0];
    }
}

$sol = new Solution();

echo $sol->MinPathSum([[1, 3], [1, 5]]);
