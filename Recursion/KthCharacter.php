<?php

class KthCharacter
{

    function kthCharacter(int $k, string $str = "a"): string
    {
        $len = strlen($str);
        //base case 
        if ($len >= $k) {
            return (string)$str[$k - 1];
        }

        $genText = "";
        for ($i = 0; $i < $len; $i++) {
            $curOrd = ord($str[$i]);
            $genText .= chr($curOrd + 1);
        }

        return $this->kthCharacter($k, $str . $genText);
    }
}


$sol = new KthCharacter();

echo $sol->kthCharacter(10);
