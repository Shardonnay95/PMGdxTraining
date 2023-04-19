<?php

// Constants
define("SAMPLE_ARRAY_ARR", [1, 1, 1, 1, 14]);

function addAll($InputArr, $TotalInt = 0) {
    if (count($InputArr) == 0) {
        return $TotalInt;
    }

    $TotalInt += array_sum($InputArr);
    array_shift($InputArr);

    return addAll($InputArr, $TotalInt);
}

$SampleArr = SAMPLE_ARRAY_ARR; // 5 + 4 + 3 + 2 + 1 = 15
echo addAll($SampleArr);
?>

