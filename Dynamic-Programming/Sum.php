<?php

class Sum
{


    public function canSum(int $target, array $numbers): bool {

        if($target === 0) return true;

        if($target < 0) return false;

        foreach($numbers as $number) {
            $remainder = $target - $number;
            if($this->canSum($remainder, $numbers) === true) {
                return true;
            }
        }

    }
}


$target = 7;
$numbers = [5,4,2,3];
$sum = new Sum();
$sum->canSum($target, $numbers);
