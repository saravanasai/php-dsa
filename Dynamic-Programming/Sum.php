<?php

class Sum
{
    public array $ways = [];

    public function bestSum(int $target, array $numbers, int $stackCounter = 0): ?array
    {
        if ($target === 0) {
            return [];
        }

        if ($target < 0) {
            return null;
        }

        foreach ($numbers as $number) {
            $remainder = $target - $number;
            $result = $this->bestSum($remainder, $numbers, $stackCounter + 1);
            if ($result !== null) {
                $result[] = $number;
                if ($stackCounter === 0) {
                    $this->ways[] = $result;
                    continue;
                }
                return $result;
            }
        }

        return null;
    }

    public function howSum(int $target, array $numbers): ?array
    {
        if ($target === 0) {
            return [];
        }

        if ($target < 0) {
            return null;
        }

        foreach ($numbers as $number) {
            $remainder = $target - $number;
            $result = $this->howSum($remainder, $numbers);
            if ($result !== null) {
                $result[] = $number;
                return $result;
            }
        }

        return null;
    }

    public function canSum(int $target, array $numbers): bool
    {
        if ($target === 0) {
            return true;
        }

        if ($target < 0) {
            return false;
        }

        foreach ($numbers as $number) {
            $remainder = $target - $number;
            if ($this->canSum($remainder, $numbers)) {
                return true;
            }
        }
    }
}


$target = 8;
$numbers = [2, 5, 3];
$sum = new Sum();
echo "output:" . (bool)$sum->canSum($target, $numbers);
echo "\n";
$sum->bestSum($target, $numbers);
echo "output:" . json_encode($sum->ways);
