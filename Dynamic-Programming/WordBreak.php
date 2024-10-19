<?php

class Solution
{

    /**
     * @param String $s
     * @param String[] $wordDict
     * @return Boolean
     */
    function wordBreak($s, $wordDict)
    {

        $wordDict = array_flip($wordDict);
        $n = strlen($s);
        $dp = array_fill(0, $n + 1, false);
        $dp[0] = true;

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($dp[$j] && isset($wordDict[substr($s, $j, $i - $j)])) {
                    $dp[$i] = true;
                    break;
                }
            }
        }

        return $dp[$n];
    }
}


$sol = new  Solution();
$s = "aaaaaaa";
$wordDict = ["aaaa", "aaa"];
echo "Output:" . (bool)$sol->wordBreak($s, $wordDict);
