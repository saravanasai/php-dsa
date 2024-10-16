<?php

function distanceTraveled(int $mainTank, int $additionalTank): int
{
    $totalDistance = 0;
    $mileagePerUnit = 10;
    $unitsConsumed = 0;

    while ($mainTank > 0) {
        $unitsConsumed++;

        // Refuel from additional tank every 5 units consumed
        if ($unitsConsumed % 5 === 0 && $additionalTank > 0) {
            $mainTank += 1;
            $additionalTank--;
            $unitsConsumed = 0;
        }

        $totalDistance += $mileagePerUnit;
        $mainTank--;
    }

    return $totalDistance;
}
echo distanceTraveled(5, 10);
