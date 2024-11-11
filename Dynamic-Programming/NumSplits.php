<?php

class Solution
{

    /**
     * @param String $s
     * @return Integer
     */
    function numSplits($s): int
    {

        $strLen = strlen($s);
        $ways = 0;
        for ($i = 0; $i < $strLen; $i++) {

            $first =  substr($s, 0 , $i+1);
            $second = substr($s, $i+1 , $strLen);
            $fCount = strlen(count_chars($first,3));
            $sCount = strlen(count_chars($second,3));

            if ($fCount == $sCount) {
                $ways++;
            }
        }


        return $ways;
    }
}


$sol = new Solution();
$sol->numSplits("aacaba");
